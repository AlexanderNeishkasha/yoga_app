<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $fillable = ['date', 'morning', 'evening', 'user_id'];
    public $timestamps = false;
    protected $attributes = [
        'morning' => false,
        'evening' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $user_id)
    {
        return $query->whereUserId($user_id);
    }
}

