<?php

namespace App\Services;

use App\Helpers;
use App\Models\PaymentLink;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Xendit\BalanceAndTransaction\Currency;
use Xendit\PaymentMethod\DirectDebitChannelCode;
use Xendit\PaymentMethod\EWalletChannelCode;
use Xendit\PaymentMethod\PaymentMethodApi;
use Xendit\PaymentMethod\PaymentMethodReusability;
use Xendit\PaymentMethod\PaymentMethodType;
use Xendit\PaymentMethod\QRCodeChannelCode;
use Xendit\PaymentMethod\VirtualAccountChannelCode;
use Xendit\PaymentRequest\DirectDebitChannelProperties;
use Xendit\PaymentRequest\PaymentRequest;
use Xendit\PaymentRequest\PaymentRequestApi;
use Xendit\PaymentRequest\PaymentRequestParameters;
use Xendit\XenditSdkException;

class ChargeService
{
    use Helpers;

    private PaymentMethodApi $paymentMethodApi;
    private PaymentRequestApi $paymentRequestApi;
    private PaymentRequestParameters $paymentRequestParameters;

    public function __construct()
    {
        $this->paymentMethodApi = new PaymentMethodApi();
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

        if ($requests["channel_code"] === "CARD") {
            $this->paymentRequestParameters->setPaymentMethodId($paymentMethodPayload["payment_method_id"]);
        } else {
            $this->paymentRequestParameters->setPaymentMethod($paymentMethodPayload);
        }

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
        if (in_array($requests["channel_code"], VirtualAccountChannelCode::getAllowableEnumValues(), true))
            return $this->VAPayload($requests, $paymentLink);

        // If Payment Method Ewallet
        if (in_array($requests["channel_code"], EWalletChannelCode::getAllowableEnumValues(), true))
            return $this->ewalletPayload($requests, $paymentLink);

//         if Payment Method Qr
        if ($requests["channel_code"] === QRCodeChannelCode::QRIS)
            return $this->qrPayload($paymentLink);

        // If Payment Method Direct Debit.
        if (in_array(explode("_", $requests["channel_code"])[0], DirectDebitChannelCode::getAllowableEnumValues(), true))
            return $this->DDPayload($requests, $paymentLink);

        // If Payment Method Card
        if ($requests["channel_code"] === "CARD") {
            $payload = $this->createCardPaymentMethodPayload($requests);
            return $this->cardPayload($payload, $paymentLink);
        }

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

    private function DDPayload(array $requests, PaymentLink $paymentLink): array
    {
        $channelCode = explode("_", $requests["channel_code"])[0];
        $channelProperties = new DirectDebitChannelProperties();

        if ($channelCode === DirectDebitChannelCode::MANDIRI) {
            $channelProperties->setSuccessReturnUrl(
                $paymentLink->success_payment_redirect ?? Setting::successRedirectUrl());
            $channelProperties->setFailureReturnUrl(Setting::failedRedirectUrl());
        }

        if ($channelCode === DirectDebitChannelCode::BRI) {
            $channelProperties->setMobileNumber("+62" . $requests["mobile_num"]);
            $channelProperties->setCardLastFour($requests["last_four_digits"]);
            $channelProperties->setEmail($requests["email"]);
        }

        $this->paymentRequestParameters->setCustomerId("cust-e289be36-c773-4252-9b62-d5648dffd431");

        return [
            "type" => PaymentMethodType::DIRECT_DEBIT,
            "reusability" => PaymentMethodReusability::ONE_TIME_USE,
            "direct_debit" => [
                "channel_code" => $channelCode,
                "channel_properties" => $channelProperties
            ]
        ];
    }

    public function createCardPaymentMethodPayload(array $requests): array
    {
        $validThru = explode("/", $requests["valid_thru"]);

        return [
            "type" => PaymentMethodType::CARD,
            "reusability" => PaymentMethodReusability::ONE_TIME_USE,
            "card" => [
                "currency" => Currency::IDR,
                "channel_properties" => [
                    "success_return_url" => $paymentLink->success_payment_redirect ?? Setting::successRedirectUrl(),
                    "failure_return_url" => Setting::failedRedirectUrl(),
                ],
                "card_information" => [
                    "card_number" => $requests["card_number"],
                    "expiry_month" => $validThru[0],
                    "expiry_year" => "20" . $validThru[1],
                    "cvv" => $requests["cvn"]
                ]
            ]
        ];
    }

    public function cardPayload(array $payload, PaymentLink $paymentLink): array
    {
        try {
            $response = $this->paymentMethodApi->createPaymentMethod(payment_method_parameters: $payload);
        } catch (XenditSdkException $e) {
            Log::error($e);
            throw new InternalErrorException('Failed to process payment request');
        }

        return [
            "payment_method_id" => $response->getId()
        ];
    }
}
