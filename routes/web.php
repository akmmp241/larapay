<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

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
