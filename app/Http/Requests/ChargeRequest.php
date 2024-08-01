<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChargeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && ! is_null(Setting::xenditApiKey());
    }

    public function rules(): array
    {
        return [
            "id" => ['required'],
            'channel_code' => ['required'],
            'mobile_num' => ['nullable'],
            'last_four_digits' => ['nullable'],
            'email' => ['nullable'],
            'card_number' => ['nullable'],
            'valid_thru' => ['nullable'],
            'cvn' => ['nullable'],
        ];
    }
}
