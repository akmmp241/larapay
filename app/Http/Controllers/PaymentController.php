<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChargeRequest;
use App\Http\Requests\CreatePaymentLinkRequest;
use App\Mail\NewOrderMail;
use App\Models\PaymentLink;
use App\Models\Setting;
use App\Services\ChargeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xendit\PaymentMethod\PaymentMethodType;
use Xendit\PaymentMethod\VirtualAccount;
use Xendit\PaymentMethod\VirtualAccountChannelProperties;
use Xendit\PaymentRequest\PaymentMethod;
use Xendit\PaymentRequest\PaymentRequestStatus;
use Xendit\XenditSdkException;

class PaymentController extends Controller
{
    private ChargeService $chargeService;

    public function __construct()
    {
        $this->chargeService = new ChargeService();
    }

    public function paymentLinks(): View
    {
        return view('payment-links.payment-links');
    }

    public function create(): View
    {
        $referenceId = Str::uuid()->toString();
        return view('payment-links.create-payment-link', compact('referenceId'));
    }

    public function store(CreatePaymentLinkRequest $request): RedirectResponse
    {
        $requests = $request->validated();
        $dateNow = Date::now();

        $payload = [
            "id" => $requests['id'],
            "amount" => $requests['amount'],
            "status" => "PENDING",
            "description" => $requests['description'] ?? null,
            "expire_date" => $requests['expire_date'] ?? $dateNow->addDay(),
            "success_payment_redirect" => $requests['success_payment_redirect'] ?? Setting::successRedirectUrl(),
            "payment_method" => "all",
            "payer_email" => $requests['payer_email'] ?? null,
            "payer_name" => $requests['payer_name'] ?? null,
            "payer_phone_num" => $requests['payer_phone_num'] ?? null,
            "created_at" => $dateNow,
            "updated_at" => $dateNow,
        ];

        PaymentLink::query()->create($payload);

        // if payer email not null and send via email checked then send email.
        $payerEmailIsNotNull = isset($requests['payer_email']);
        $sendLinkViaEmailIsChecked = isset($requests["send_link_via"]) && $requests["send_link_via"][0] === "on";
        if ($payerEmailIsNotNull && $sendLinkViaEmailIsChecked) Mail::to($requests["payer_email"])
            ->send(new NewOrderMail($requests["payer_email"]));

        return Redirect::to(route('payment-links'))->with([
            "success" => "Berhasil membuat link pembayaran",
        ]);
    }

    public function checkout($transactionId): View
    {
        $paymentLink = PaymentLink::query()->findOrFail($transactionId);
        $ovo = view('payment-links.components.ovo', compact('paymentLink'));
        return view('payment-links.checkout', compact('paymentLink', 'ovo'));
    }

    public function charge(ChargeRequest $request): RedirectResponse
    {
        $requests = $request->validated();

        $paymentLink = PaymentLink::query()->where('id', $requests["id"])->first();
        if (!$paymentLink) throw new NotFoundHttpException();

        try {
            $response = $this->chargeService->createCharge($requests, $paymentLink);
            Log::info($response);
        } catch (XenditSdkException $e) {
            Log::error($e);
            return Redirect::back()->withErrors(['error' => $e->getErrorMessage()]);
        } catch (InternalErrorException $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()]);
        }

        // If response REQUIRES_ACTION then redirect to the url action.
        if ($response->getStatus() == PaymentRequestStatus::REQUIRES_ACTION) {
            return Redirect::to($response->getActions()[0]["url"]);
        }

        // If response PENDING process the response
        if ($response->getStatus() == PaymentRequestStatus::PENDING) {
            // lower channel code
            $unCapitalChannelCode = strtolower($requests['channel_code']);
            // payment method type
            $paymentMethodtype = $response->getPaymentMethod()["type"];
            $lowerType = strtolower($paymentMethodtype);
            // channel properties
            $channelProperties = $response->getPaymentMethod()["$lowerType"]["channel_properties"];

            // If the payment method type Ewallet [OVO] then redirect with the page.
            if ($paymentMethodtype == PaymentMethodType::EWALLET) return Redirect::back()->with([
                'success-page-ovo' => $unCapitalChannelCode . '-success'
            ]);

            // If the payment method type Virtual Account then redirect with bank page.
            if ($paymentMethodtype == PaymentMethodType::VIRTUAL_ACCOUNT)
                return Redirect::back()->with([
                    'success-page-bank' => view('payment-links.components.bank-success', [
                        "vaNumber" => $channelProperties["virtual_account_number"],
                        "vaName" => $channelProperties["customer_name"],
                    ])->render()
                ]);

            // If the payment method QRCode then redirect with the QR string.
            if ($paymentMethodtype == PaymentMethodType::QR_CODE)
                return Redirect::back()->with([
                    'success-page-qrcode' => view('payment-links.components.qr-code', [
                        "qr_string" => $channelProperties["qr_string"],
                        "expires_at" => $channelProperties["expires_at"]
                    ])->render()
                ]);
        }

        return Redirect::back();
    }
}
