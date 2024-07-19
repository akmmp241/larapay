<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DuplicateUsername implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::query()->where("username", $value)->first();
        if ($user) $fail("$attribute sudah terdaftar");
    }
}
