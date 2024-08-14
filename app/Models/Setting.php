<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'xendit_mode';
    public $incrementing = false;


    public static string $LIVE = "live";
    public static string $SANDBOX = "sandbox";

    protected $fillable = [
        'xendit_mode',
        'xendit_api_key',
        'xendit_webhook_token',
        'default_payment_method',
        'default_redirect_url'
    ];

    protected $casts = [
        "default_payment_method" => 'array',
        "default_redirect_url" => 'array'
    ];

    public static function xenditMode(): ?string
    {
        return self::query()->first()->xendit_mode;
    }

    public static function checkMode(string $mode): bool
    {
        return self::xenditMode() === $mode;
    }

    public static function setMode(string $mode): void
    {
        self::query()->first()->update([
            "xendit_mode" => $mode
        ]);
    }

    public static function xenditApiKey(): ?string
    {
        return self::query()->first()->xendit_api_key;
    }

    public static function xenditWebhookToken(): ?string
    {
        return self::query()->first()->xendit_webhook_token;
    }

    public static function paymentMethods(): ?array
    {
        return self::query()->first()->default_payment_method;
    }

    public static function defaultRedirectUrl(): ?array
    {
        return self::query()->first()->default_redirect_url;
    }

    public static function successRedirectUrl(): ?string
    {
        return self::defaultRedirectUrl()["success"];
    }

    public static function failedRedirectUrl(): ?string
    {
        return self::defaultRedirectUrl()["failure"];
    }
}
