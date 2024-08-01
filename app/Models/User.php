<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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



}
