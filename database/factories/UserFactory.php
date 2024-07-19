<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'role_id' => User::$ADMIN,
            'first_name' => fake()->firstName('male'),
            'last_name' => fake()->lastName('male'),
            'email' => fake()->safeEmail(),
            'username' => fake()->username(),
            'password' => static::$password ??= Hash::make('password'),
            'profile_pic' => fake()->imageUrl(),
            'mobile_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes): array => [
            'email' => 'admin@admin.com',
            'username' => 'admin',
        ]);
    }

    public function member(): static
    {
        return $this->state(fn(array $attributes): array => [
            'role_id' => User::$MEMBER,
        ]);
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
