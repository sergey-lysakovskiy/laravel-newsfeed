<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Authentication failed');
        }

        $user = User::whereEmail($credentials['email'])
            ->firstOrFail();

        return response()->json([
            'access_token' => $user->createToken('authToken')->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }
}
