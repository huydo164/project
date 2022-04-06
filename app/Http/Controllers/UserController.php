<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(loginRequest $request)
    {
        if (!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json('Unauthorized', 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function test()
    {
        return 123;
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
}
