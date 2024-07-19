<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('auth.profile');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', fn() => view('users.manage'));
        Route::get('/new', fn() => view('users.add-user'));
        Route::get('/iduser', fn() => view('users.edit-user'));
    });

    Route::get('/dashboard', fn() => view('dashboard'));

    Route::prefix('/payment-links')->group(function () {
        Route::get('/', fn() => view('payment-links.payment-links'));

        Route::get('/create', fn() => view('payment-links.create-payment-link'));
    });


    Route::prefix('/settings')->group(function () {
        Route::get('/', fn() => view('settings.settings'));

        Route::prefix('/xendit')->group(function () {
            Route::get('/api-key', fn() => view('settings.set-xendit-api-key'));
            Route::get('/webhook', fn() => view('settings.set-webhook'));
        });

        Route::get('/payment-methods', fn() => view('settings.set-default-payment-methods'));

        Route::get('/redirect', fn() => view('settings.set-default-redirect'));
    });

    Route::get('/checkout/transactionID', fn() => view('payment-links.checkout'));

});
