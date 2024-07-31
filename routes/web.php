<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use App\Http\Middleware\CheckExpiredPaymentMiddleware;
use App\Http\Middleware\CheckUndoneSettingsMiddleware;
use App\Http\Middleware\XenditWebhookMiddleware;
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
    Route::controller(PaymentController::class)->group(function () {
        Route::prefix('/payment-links')->group(function () {
            Route::get('/', 'paymentLinks')->name('payment-links');
            Route::get('/create', 'create')->name('payment-links.create');
            Route::post('/create', 'store')->name('payment-links.store');
            Route::get('/{id}', 'detail')->name('payment-links.detail');
        });
        Route::get('/checkout/{referenceId}', 'checkout')->name('payment-links.checkout');
        Route::post('/charge', 'charge')->name('charge');
        Route::post('/validate/otp', 'validateOtp')
            ->withoutMiddleware(['auth', CheckUndoneSettingsMiddleware::class])
            ->name('validate.otp');
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
});

Route::middleware(XenditWebhookMiddleware::class)->group(function () {
    Route::post('/handle/succeed', [WebhookController::class, 'succeeded'])->name('webhook.success');
    Route::post('/handle/pending', [WebhookController::class, 'pending'])->name('webhook.pending');
    Route::post('/handle/failed', [WebhookController::class, 'failed'])->name('webhook.failed');
});
