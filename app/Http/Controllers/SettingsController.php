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
        $successUrl = Setting::successRedirectUrl();
        $failedUrl = Setting::failedRedirectUrl();
        return view('settings.set-default-redirect', compact('successUrl', 'failedUrl'));
    }

    public function storeRedirect(SetRedirectRequest $request): RedirectResponse
    {
        $request->validated();

        Setting::query()->first()->update([
            "payment_success_redirect_url" => $request->get('success_url'),
            "payment_failed_redirect_url" => $request->get('failed_url')
        ]);

        return Redirect::back()->with([
            "success" => "Success change your default redirect!"
        ]);
    }
}
