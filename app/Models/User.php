<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'username', 'photo_url', 'auth_date'];
}
