<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePaymentLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && ! is_null(Setting::xenditApiKey());
    }

    public function rules(): array
    {
        return [
            "id" => ["required", "uuid"],
            "amount" => ["required", "numeric"],
            "description" => ["nullable", "string"],
            "payer_name" => ["nullable", "string"],
            "payer_email" => ["nullable", "email"],
            "payer_mobile_num" => ["nullable", "string"],
            "send_link_via" => ["nullable"],
            "expire_date" => ["nullable", "date"],
            "success_payment_redirect" => ["nullable", "url:https"],
            "failed_link" => ["nullable", "url:https"],
        ];
    }
}
