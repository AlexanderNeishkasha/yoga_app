<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['id', 'first_name', 'last_name', 'username', 'photo_url', 'auth_date'];

    public function marks()
    {
        return $this->hasMany(Marks::class);
    }
}
