<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::Create($request->validated());

        $token = $user->createToken('auth_token', ['*'], now()->addWeek());

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'token' => $token->plainTextToken,
            'user' => $user,
            'expires_at' => $token->accessToken->expires_at
        ], 201);
    }

    /**
     * Log the user in.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();
        $request->authenticate();
        $token = $request->user()->createToken('auth_token', ['*'], now()->addWeek());

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'token' => $token->plainTextToken,
            'user' => $request->user(),
            'expires_at' => $token->accessToken->expires_at
        ]);
    }

    /**
     * Refresh the user's token.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('auth_token', ['*'], now()->addWeek());
        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully',
            'token' => $token->plainTextToken,
            'user' => $request->user(),
            'expires_at' => $token->accessToken->expires_at
        ]);
    }

    /**
     * Log the user out.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User logged out successfully',
        ]);
    }
}
