<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Xendit\PaymentMethod\EWalletChannelCode;

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
            'mobile_num' => [Rule::requiredIf(fn () => $this->get('channel_code') === EWalletChannelCode::OVO)],
        ];
    }
}
