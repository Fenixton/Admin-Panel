<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    protected $table = 'togo_managers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

class UserGroup {
    const MANAGER = 0;
    const ADMIN = 1;

    public static function isAdmin($userGroup) {
        return self::ADMIN == (int) $userGroup;
    }
}
