<?php

namespace App\Http\Requests;

use App\Rules\OldPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "password" => ["required", "min:8", "confirmed"],
            "current_password" => ["required", new OldPassword],
        ];
    }
}
