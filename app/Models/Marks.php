<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $fillable = ['date', 'morning', 'evening'];
    public $timestamps = false;
}

