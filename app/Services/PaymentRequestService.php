<?php

namespace App\Services;

use App\Helpers;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Xendit\PaymentRequest\PaymentRequest;
use Xendit\PaymentRequest\PaymentRequestAction;
use Xendit\PaymentRequest\PaymentRequestApi;
use Xendit\XenditSdkException;

class PaymentRequestService
{
    use Helpers;
    private PaymentRequestApi $paymentRequestApi;

    public function __construct()
    {
        $this->paymentRequestApi = new PaymentRequestApi();
    }

    public function get(string $pr_id): PaymentRequest
    {
        try {
            return $this->paymentRequestApi->getPaymentRequestByID($pr_id);
        } catch (XenditSdkException $e) {
            Log::error($e);
            throw new InternalErrorException('Failed to process payment request');
        }
    }

    public function validateOtp(PaymentRequestAction $prAction, string $otpCode): void
    {

        try {
            Http::asJson()->timeout(15)->retry(3, 1000)
                ->withHeaders([
                    "Authorization" => "Basic " . base64_encode(env('XENDIT_API_KEY') . ':'),
                ])->accept("application/json")
                ->contentType("application/json")
                ->post($prAction->getUrl(), [
                    "auth_code" => $otpCode,
                ])->throw();
        } catch (ConnectionException|RequestException $e) {
            Log::error($e);
            throw new InternalErrorException('Failed to connect to Xendit server');
        }
    }
}
