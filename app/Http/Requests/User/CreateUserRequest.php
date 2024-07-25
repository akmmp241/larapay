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
            "email" => ["required", "email"],
            "role_id" => ["required", "string"],
            "password" => ["required", Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            "password" => ':attribute minimal 3 karakter dan mengandung huruf besar, kecil dan angka',
        ];
    }
}
