<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            "xendit_mode" => "sandbox",
            "xendit_api_key" => null,
            "xendit_webhook_token" => null,
            "default_payment_method" => null,
            "payment_success_redirect_url" => null,
            "payment_failed_redirect_url" => null,
        ];
    }
}
