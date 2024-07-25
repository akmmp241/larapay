<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class GetPaymentLinksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "from_date" => ["nullable", "date"],
            "to_date" => ["nullable", "date", "required_with:from_date", "after_or_equal:from_date"],
            "status" => ["nullable", "string"],
            "search" => ["nullable", "string", "max:255"],
            "search_by" => ["nullable"],
        ];
    }
}
