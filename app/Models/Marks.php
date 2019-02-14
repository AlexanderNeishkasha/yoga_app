<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Marks extends Model
{
    protected $fillable = ['date', 'morning', 'evening', 'user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $user_id)
    {
        return $query->whereUserId($user_id);
    }
}

