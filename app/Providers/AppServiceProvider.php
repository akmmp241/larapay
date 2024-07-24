<?php

namespace App\Providers;

use Illuminate\Support\Env;
use Illuminate\Support\ServiceProvider;
use Xendit\Configuration;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Configuration::setXenditKey(Env::get('XENDIT_API_KEY'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
