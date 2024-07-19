<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            "first_name" => ["required", "string"],
            "last_name" => ["nullable", "string"],
            "username" => ["required", "string", "min:3", "max:15"],
            "email" => ["required", "email"],
            "role_id" => ["required", "string"],
            "password" => ["required", Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            "username.min" => ':attribute minimal 3 karakter',
            "username.max" => ':attribute maksimal 15 karakter',
            "password" => ':attribute minimal 3 karakter dan mengandung huruf besar, kecil dan angka',
        ];
    }
}
