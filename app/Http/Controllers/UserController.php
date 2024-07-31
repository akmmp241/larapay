<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Rules\DuplicateEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard');
    }

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
            // check duplicate email
            new DuplicateEmail(),
        ]);

        User::query()->create($requests);

        return Redirect::intended(route('users'))->with('success', 'User berhasil dibuat');
    }

    public function users(): View
    {
        $users = User::all();
        return view('users.manage', compact('users'));
    }

    public function edit(string $id): View|RedirectResponse
    {
        $user = User::query()->findOrFail($id);

        // Redirect if user try to edit his own profile
        if ($user->id === Auth::id()) return Redirect::to(route('profile'));

        return view('users.edit-user', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $requests = $request->validated();

        $user = User::query()->findOrFail($id);
        $user->update($requests);

        return Redirect::intended(route('users'))->with('success', 'User berhasil diupdate');
    }
}
