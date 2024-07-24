<?php

namespace App\Services;

use App\Helpers;
use App\Models\PaymentLink;
use App\Models\Setting;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Xendit\PaymentMethod\EWalletChannelCode;
use Xendit\PaymentMethod\PaymentMethodReusability;
use Xendit\PaymentMethod\PaymentMethodType;
use Xendit\PaymentMethod\QRCodeChannelCode;
use Xendit\PaymentMethod\VirtualAccountChannelCode;
use Xendit\PaymentRequest\PaymentMethod;
use Xendit\PaymentRequest\PaymentRequest;
use Xendit\PaymentRequest\PaymentRequestApi;
use Xendit\PaymentRequest\PaymentRequestParameters;
use Xendit\XenditSdkException;

class ChargeService
{
    use Helpers;
    private PaymentRequestApi $paymentRequestApi;
    private PaymentRequestParameters $paymentRequestParameters;

    public function __construct()
    {
        $this->paymentRequestApi = new PaymentRequestApi();
        $this->paymentRequestParameters = new PaymentRequestParameters([
            "currency" => "IDR",
            "country" => "ID",
        ]);
    }

    /**
     * @throws InternalErrorException
     * @throws XenditSdkException
     */
    public function createCharge(array $requests, PaymentLink $paymentLink): PaymentRequest
    {
        $paymentMethodPayload = $this->setPaymentMethod($requests, $paymentLink);

        $this->paymentRequestParameters->setAmount($paymentLink->amount);
        $this->paymentRequestParameters->setReferenceId($paymentLink->id);
        $this->paymentRequestParameters->setPaymentMethod($paymentMethodPayload);

        try {
            return $this->paymentRequestApi->createPaymentRequest(payment_request_parameters: $this->paymentRequestParameters);
        } catch (XenditSdkException $e) {
            Log::error($e);
            if (str_contains($e->getErrorMessage(), "Amount for this channel"))
                throw new XenditSdkException(
                null,
                $e->getErrorCode(),
                str_replace("this channel", self::$NORMALISE_NAME[$requests["channel_code"]], $e->getErrorMessage())
            );
            throw new InternalErrorException('Failed to process payment request');
        }
    }

    private function setPaymentMethod(array $requests, PaymentLink $paymentLink): ?array
    {
        // If Payment Method Virtual Account
        if (in_array($requests["channel_code"], VirtualAccountChannelCode::getAllowableEnumValues(), true)) {
            return $this->VAPayload($requests, $paymentLink);
        }

        // If Payment Method Ewallet
        if (in_array($requests["channel_code"], EWalletChannelCode::getAllowableEnumValues(), true)) {
            return $this->ewalletPayload($requests, $paymentLink);
        }

//         if Payment Method Qr
        if ($requests["channel_code"] === QRCodeChannelCode::QRIS) {
            return $this->qrPayload($paymentLink);
        }
//
//        if (in_array($channelCode, OverTheCounterChannelCode::getAllowableEnumValues(), true)) {
//            return $this->overTheCounterPayload($channelCode);
//        }

        return null;
    }

    private function VAPayload(array $requests, PaymentLink $paymentLink): array
    {
        return [
            "type" => PaymentMethodType::VIRTUAL_ACCOUNT,
            "reusability" => PaymentMethodReusability::ONE_TIME_USE,
            "virtual_account" => [
                "channel_code" => $requests["channel_code"],
                "channel_properties" => [
                    "customer_name" => $paymentLink->payer_name ?? "Larapay Customer",
                    "expires_at" => $paymentLink->expire_date ?? null
                ],
            ]
        ];
    }

    private function ewalletPayload(array $requests, PaymentLink $paymentLink): array
    {
        return [
            "type" => PaymentMethodType::EWALLET,
            "reusability" => PaymentMethodReusability::ONE_TIME_USE,
            "ewallet" => [
                "channel_code" => $requests["channel_code"],
                "channel_properties" => [
                    "success_return_url" => $paymentLink->success_payment_redirect ?? Setting::successRedirectUrl(),
                    "failure_return_url" => Setting::failedRedirectUrl(),
                    "mobile_number" => $requests["mobile_num"] ?? $paymentLink->mobile_num ?? null,
                ],
            ]
        ];
    }

    private function qrPayload(PaymentLink $paymentLink): array
    {
        return [
            "type" => PaymentMethodType::QR_CODE,
            "reusability" => PaymentMethodReusability::ONE_TIME_USE,
            "qr_code" => [
                "channel_code" => QRCodeChannelCode::DANA,
                "channel_properties" => [
                    "expires_at" => $paymentLink->expire_date ?? null,
                ],
            ]
        ];
    }
}
