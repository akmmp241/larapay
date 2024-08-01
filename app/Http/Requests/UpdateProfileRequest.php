<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            "mobile_number" => ['nullable', 'numeric'],
            "address" => ['nullable', 'string'],
        ];
    }
}
