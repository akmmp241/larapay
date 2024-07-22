<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUndoneSettingsMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest middleware register
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Auth middleware register
Route::middleware(['auth', CheckUndoneSettingsMiddleware::class])->group(function () {

    Route::controller(UserController::class)->group(function () {
        // Dashboard
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        // Users routes
        Route::prefix('/users')->group(function () {
            // TODO
            Route::get('/', fn() => view('users.manage'));

            Route::get('/new', 'add')->name('users.add');
            Route::post('/new', 'store')->name('users.store');

            // TODO
            Route::get('/iduser', fn() => view('users.edit-user'));
        });

        // TODO
        Route::get('/profile', function () {
            return view('auth.profile');
        });
    });


    // Payment links routes
    Route::prefix('/payment-links')->group(function () {
        // TODO
        Route::get('/', fn() => view('payment-links.payment-links'));

        // TODO
        Route::get('/create', fn() => view('payment-links.create-payment-link'));
    });


    // Settings routes
    Route::prefix('/settings')->withoutMiddleware([CheckUndoneSettingsMiddleware::class])->controller(SettingsController::class)->group(function () {
        Route::get('/', 'settings');

        Route::prefix('/xendit')->group(function () {
            Route::get('/api-key', 'setApiKey')->name('settings.api-key');
            Route::patch('/api-key', 'storeApiKey')->name('settings.api-key.store');

            Route::get('/webhook', 'setWebhook')->name('settings.webhook');
            Route::patch('/webhook', 'storeWebhook')->name('settings.webhook.store');
        });

        // TODO
        Route::get('/payment-methods', fn() => view('settings.set-default-payment-methods'));

        Route::get('/redirect', 'setRedirect')->name('settings.redirect');
        Route::patch('/redirect', 'storeRedirect')->name('settings.redirect.store');
    });

    // TODO
    Route::get('/checkout/transactionID', fn() => view('payment-links.checkout'));

});
