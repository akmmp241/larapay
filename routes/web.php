<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\User\UserController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'));

    Route::get('/profile', function () {
        return view('auth.profile');
    });

    // users routes
    Route::prefix('/users')->group(function () {
        Route::get('/', fn() => view('users.manage'));

        Route::get('/new', [UserController::class, 'add'])->name('users.add');
        Route::post('/new', [UserController::class, 'store'])->name('users.store');

        Route::get('/iduser', fn() => view('users.edit-user'));
    });


    // payment links routes
    Route::prefix('/payment-links')->group(function () {
        Route::get('/', fn() => view('payment-links.payment-links'));

        Route::get('/create', fn() => view('payment-links.create-payment-link'));
    });


    // settings routes
    Route::prefix('/settings')->controller(SettingsController::class)->group(function () {
        Route::get('/', fn() => view('settings.settings'));

        Route::prefix('/xendit')->group(function () {
            Route::get('/api-key', 'setApiKey')->name('settings.api-key');
            Route::patch('/api-key', 'storeApiKey')->name('settings.api-key.store');

            Route::get('/webhook', 'setWebhook')->name('settings.webhook');
            Route::patch('/webhook', 'storeWebhook')->name('settings.webhook.store');
        });

        Route::get('/payment-methods', fn() => view('settings.set-default-payment-methods'));

        Route::get('/redirect', 'setRedirect')->name('settings.redirect');
        Route::patch('/redirect', 'storeRedirect')->name('settings.redirect.store');
    });

    Route::get('/checkout/transactionID', fn() => view('payment-links.checkout'));

});
