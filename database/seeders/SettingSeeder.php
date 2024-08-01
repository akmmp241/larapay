<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::factory()->create();

        Setting::query()->first()->update([
            "default_payment_method" => [
                "ewallet" => [
                    "dana" => true,
                    "linkaja" => true,
                    "ovo" => true,
                    "shopeepay" => true,
                ],
                "va" => [
                    "bjb" => true,
                    "bnc" => true,
                    "cimb" => true,
                    "permata" => true,
                    "mandiri" => true,
                    "sahabat_sampoerna" => true,
                    "bca" => true,
                    "bri" => true,
                    "bsi" => true,
                    "bni" => true,
                ],
                "otc" => [
                    "indomaret" => true,
                    "alfamart" => true,
                ],
                "qris" => true,
                "dd" => [
                    "bri_dd" => true,
                    "mandiri_dd" => true,
                ],
                "cc" => true,
            ]
        ]);
    }
}
