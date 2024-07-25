<?php

namespace App\Http\Controllers;

use App\Models\PaymentLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xendit\PaymentRequest\Error;
use Xendit\PaymentRequest\PaymentCallbackData;

class WebhookController extends Controller
{
    public function succeeded(Request $request): JsonResponse
    {
        $data = new PaymentCallbackData($request->get('data'));
        $paidAt = Date::parse($data->getUpdated())->setTimezone('Asia/Jakarta')->toDateTimeString();
        $paymentMethodType = $data->getPaymentMethod()["type"];

        // Check for payment link
        $paymentLink = PaymentLink::query()->where('id', $data['reference_id'])->first();
        if (!$paymentLink) throw new NotFoundHttpException("Payment link not found");

        // Update Payment link
        $paymentLink->xendit_pr_id = $data->getPaymentRequestId();
        $paymentLink->status = "PAID";
        $paymentLink->paid_at = $paidAt;
        $paymentLink->channel_code = $data->getPaymentMethod()[strtolower($paymentMethodType)]["channel_code"];
        $paymentLink->updated_at = Date::now();
        $paymentLink->save();

        return Response::json(["message" => "OK"]);
    }

    public function pending(): JsonResponse
    {
        return Response::json(["message" => "OK"]);
    }

    public function failed(Request $request)
    {
        $data = new PaymentCallbackData($request->get('data'));
        $paymentMethodType = $data->getPaymentMethod()["type"];

        // Check for payment link
        $paymentLink = PaymentLink::query()->where('id', $data['reference_id'])->first();
        if (!$paymentLink) throw new NotFoundHttpException("Payment link not found");

        // Handle Failure
        $failureCode = $data->getFailureCode();
        if ($data->getFailureCode() === "USER_DECLINED_PAYMENT") $failureCode = "USER_MENOLAK_MEMBAYAR";
        if ($data->getFailureCode() === Error::ERROR_CODE_ACCOUNT_ACCESS_BLOCKED)
            $failureCode = "AKSESS_TERBLOKIR";
        if ($data->getFailureCode() === Error::ERROR_CODE_INVALID_ACCOUNT_DETAILS)
            $failureCode = "DETAIL_USER_TIDAK_VALID";
        if ($data->getFailureCode() === Error::ERROR_CODE_INSUFFICIENT_BALANCE)
            $failureCode = "SALDO_USER_TIDAK_CUKUP";


        // Update Payment link
        $paymentLink->failure_code = $failureCode;
        $paymentLink->xendit_pr_id = $data->getPaymentRequestId();
        $paymentLink->channel_code = $data->getPaymentMethod()[strtolower($paymentMethodType)]["channel_code"];
        $paymentLink->updated_at = Date::now();
        $paymentLink->save();

        return Response::json(["message" => "OK"]);
    }
}
