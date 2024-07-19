<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) return back()->withErrors([
            "not-found" => "The credentials is not match"
        ])->onlyInput();

        $request->session()->regenerate();

        return Redirect::intended('/dashboard');
    }
}
