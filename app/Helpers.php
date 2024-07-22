<?php

namespace App;

use App\Models\Setting;

trait Helpers
{
    public function checkUndoneSettings(): array
    {
        $needToSet = [];

        if (is_null(Setting::xenditApiKey())) $needToSet["api-key"] = true;
        if (is_null(Setting::xenditWebhookToken())) $needToSet["webhook-token"] = true;
        if (is_null(Setting::paymentMethods())) $needToSet["payment-methods"] = true;
        if (is_null(Setting::successRedirectUrl())) $needToSet["success-redirect-url"] = true;

        $countSettings = count($needToSet);

        return [
            "isDone" => $countSettings > 0,
            "settings" => $needToSet
        ];
    }
}
