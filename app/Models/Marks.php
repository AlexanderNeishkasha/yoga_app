<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $fillable = ['date', 'morning', 'evening', 'user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

