<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
}
