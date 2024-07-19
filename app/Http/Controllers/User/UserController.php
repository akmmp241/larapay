<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Rules\DuplicateEmail;
use App\Rules\DuplicateUsername;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function add(): View
    {
        return view('users.add-user', [
            "roles" => User::roles()
        ]);
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $requests = $request->validated();

        // check for duplicate
        $request->validate([
            // check duplicate username
            new DuplicateUsername(),
            // check duplicate email
            new DuplicateEmail(),
        ]);

        User::query()->create($requests);

        return Redirect::intended('/users')->with('success', 'User berhasil dibuat');
    }
}
