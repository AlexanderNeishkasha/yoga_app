<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function getLogin()
    {
        return response()->json([
            'success' => true,
            'data' => config('telegram.login')
        ]);
    }
}
