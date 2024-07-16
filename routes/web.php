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

Route::get('/user/manage', function () {
    return view('user.manage');
});

Route::get('/dashboard', fn() => view('dashboard'));

Route::get('/payment-link/create', fn() => view('create-payment-link'));

Route::get('/payment-link', fn() => view('payment-links'));
