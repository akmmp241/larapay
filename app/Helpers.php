<?php

namespace App;

use App\Models\Setting;
use Xendit\PaymentMethod\EWalletChannelCode;

trait Helpers
{
    static array $NORMALISE_NAME = [
        EWalletChannelCode::OVO => "Ovo",
        EWalletChannelCode::DANA => "Dana",
        EWalletChannelCode::LINKAJA => "LinkAja",
        EWalletChannelCode::ASTRAPAY => "AstraPay",
        EWalletChannelCode::JENIUSPAY => "JeniusPay",
        EWalletChannelCode::SHOPEEPAY => "ShopeePay",
    ];

    public function checkUndoneSettings(): array
    {
        $needToSet = [];

        if (is_null(Setting::xenditApiKey())) $needToSet["api-key"] = true;
        if (is_null(Setting::xenditWebhookToken())) $needToSet["webhook-token"] = true;
        if (is_null(Setting::paymentMethods())) $needToSet["payment-methods"] = true;
        if (is_null(Setting::successRedirectUrl())) $needToSet["success-redirect-url"] = true;

        $countSettings = count($needToSet);

        return [
            "isDone" => $countSettings === 0,
            "settings" => $needToSet
        ];
    }

    public static function estimatedService(?string $channelCode): ?string
    {
        $data = [
            "CARD" => "H+5 Hari",
            "BCA" => "H+1 Hari",
            "BNI" => "Instant",
            "BRI" => "Instant",
            "BJB" => "Instant",
            "BSI" => "Instant",
            "BNC" => "Instant",
            "CIMB" => "Instant",
            "BSS" => "Instant",
            "PERMATA" => "Instant",
            "MANDIRI" => "H+1 Hari",
            "LINKAJA" => "H+2 Hari",
            "SHOPEEPAY" => "H+2 Hari",
            "OVO" => "H+2 Hari",
            "DANA" => "H+2 Hari",
            "JENIUSPAY" => "H+2 Hari",
            "ASTRAPAY" => "H+2 Hari",
            "INDOMARET" => "H+5 Hari Kerja",
            "ALFAMART" => "H+5 Hari Kerja",
        ];

        return $data[$channelCode] ?? null;
    }
}
