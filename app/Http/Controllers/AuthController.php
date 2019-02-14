<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function auth(Request $request)
    {
        try {
            $userData = $this->telegramService->checkAuthorization($request->all());
            $user = User::updateOrCreate(['id' => $userData['id']], $userData);
            Auth::login($user);
            $token = $user->createToken('YogaApp')->accessToken;
            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('auth.error', ['message' => $exception->getMessage()])
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => true]);
    }
}
