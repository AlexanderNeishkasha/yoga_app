<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        Log::debug(print_r($request->all(), true));
    }
}
