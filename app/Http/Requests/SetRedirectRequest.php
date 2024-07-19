<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetRedirectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "success_url" => ["required", "url:https"],
            "failed_url" => ["required", "url:https"],
        ];
    }

    public function messages(): array
    {
        return [
            "success_url.url" => "link tidak valid",
            "failed_url.url" => "link tidak valid"
        ];
    }
}
