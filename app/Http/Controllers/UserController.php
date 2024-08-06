<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\PaymentLink;
use App\Models\User;
use App\Rules\DuplicateEmail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function dashboard(): View
    {

        $latestPaymentLinks = PaymentLink::query()->latest('created_at')->take(5)->get();

        $queryInit = DB::table('payment_links');

        $query = match (DB::getDriverName()) {
            'mysql' => $queryInit->selectRaw("DATE_FORMAT(created_at, '%M') as Month), SUM(amount) as total"),
            'sqlite' => $queryInit->selectRaw("CASE strftime('%m', created_at)
        WHEN '01' THEN 'January'
        WHEN '02' THEN 'February'
        WHEN '03' THEN 'March'
        WHEN '04' THEN 'April'
        WHEN '05' THEN 'May'
        WHEN '06' THEN 'June'
        WHEN '07' THEN 'July'
        WHEN '08' THEN 'August'
        WHEN '09' THEN 'September'
        WHEN '10' THEN 'October'
        WHEN '11' THEN 'November'
        WHEN '12' THEN 'December'
        END || ' ' || strftime('%Y', created_at) AS month,
    SUM(amount) as total"),
        };

        $incomeByMonth = $query->groupBy('Month')
            ->orderBy('month')
            ->get();

        return view('dashboard', compact('latestPaymentLinks', 'incomeByMonth'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        $requests = $request->validated();
        $user = User::query()->find(Auth::id());

        $user->update($requests);

        return Redirect::back()->with([
            "success" => "Berhasil mengubah profile!",
        ]);
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

    function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $requests = $request->validated();

        User::query()->find(Auth::id())->update([
            "password" => $requests['password']
        ]);

        return Redirect::back()->with(["success" => "Berhasil mengubah password!"]);
    }
}
