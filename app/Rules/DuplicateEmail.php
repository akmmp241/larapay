<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DuplicateEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::query()->where("email", $value)->first();
        if ($user) $fail("$attribute sudah terdaftar");
    }
}
