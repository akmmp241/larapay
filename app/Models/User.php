<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable;

    public static int $ADMIN = 1;
    public static int $MEMBER = 2;

    public static array $ROLES = [
        "Admin",
        "Member"
    ];

    public static function roles(): array
    {
        return [
            "Admin" => static::$ADMIN,
            "Member" => static::$MEMBER
        ];
    }

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_pic',
        'mobile_number',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }


    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
