<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetRedirectRequest;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public function settings(): View
    {
        return view('settings.settings');
    }
    public function setApiKey(): View
    {
        $key = Setting::xenditApiKey();
        return view('settings.set-xendit-api-key', compact('key'));
    }

    public function storeApiKey(Request $request): RedirectResponse
    {
        Setting::query()->first()->update([
            "xendit_api_key" => $request->get('key')
        ]);

        return Redirect::back()->with([
            "success" => "Success change your xendit api key!"
        ]);
    }

    public function setWebhook(): View
    {
        $token = Setting::xenditWebhookToken();
        return view('settings.set-webhook', compact('token'));
    }

    public function storeWebhook(Request $request): RedirectResponse
    {
        Setting::query()->first()->update([
            "xendit_webhook_token" => $request->get('token')
        ]);

        return Redirect::back()->with([
            "success" => "Success change your xendit webhook token!"
        ]);
    }

    public function setRedirect(): View
    {
        $successUrl = Setting::defaultRedirectUrl()["success"];
        $failedUrl = Setting::defaultRedirectUrl()["failure"];
        return view('settings.set-default-redirect', compact('successUrl', 'failedUrl'));
    }

    public function storeRedirect(SetRedirectRequest $request): RedirectResponse
    {
        $request->validated();

        $data = [
            "success" => $request->get('success_url'),
            "failure" => $request->get('failed_url')
        ];

        Setting::query()->first()->update([
            "default_redirect_url" => $data
        ]);

        return Redirect::back()->with([
            "success" => "Success change your default redirect!"
        ]);
    }

    public function setDefaultPaymentMethod(): View
    {
        $paymentMethods = Setting::paymentMethods();

        return view('settings.set-default-payment-methods', compact('paymentMethods'));
    }

    public function updateDefaultPaymentMethod(Request $request): RedirectResponse
    {
        $requests = $request->only(['ewallet', 'va', 'otc', 'qris', 'dd', 'cc']);

        $payload = [
            "ewallet" => [
                "dana" => (bool)$request->get('dana'),
                "linkaja" => (bool)$request->get('linkaja'),
                "ovo" => (bool) $request->get('ovo'),
                "shopeepay" => (bool) $request->get('shopeepay'),
            ],
            "va" => [
                "bjb" => (bool)$request->get('bjb'),
                "bnc" => (bool)$request->get('bnc'),
                "cimb" => (bool)$request->get('cimb'),
                "permata" => (bool)$request->get('permata'),
                "mandiri" => (bool)$request->get('mandiri'),
                "sahabat_sampoerna" => (bool)$request->get('sahabat_sampoerna'),
                "bca" => (bool)$request->get('bca'),
                "bri" => (bool)$request->get('bri'),
                "bsi" => (bool)$request->get('bsi'),
                "bni" => (bool)$request->get('bni'),
            ],
            "otc" => [
                "indomaret" => (bool)$request->get('indomaret'),
                "alfamart" => (bool)$request->get('alfamart'),
            ],
            "qris" => (bool)$request->get('qris'),
            "dd" => [
                "bri_dd" => (bool)$request->get('bri_dd'),
                "mandiri_dd" => (bool)$request->get('mandiri'),
            ],
            "cc" => (bool)$request->get('cc'),
        ];

        Setting::query()->first()->update([
            "default_payment_method" => $payload,
        ]);

        return Redirect::back()->with(["success" => "Success change your default payment method!"]);
    }
}
