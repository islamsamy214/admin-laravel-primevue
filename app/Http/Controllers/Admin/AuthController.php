<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{
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
        
        if (! in_array($request->user()->role, ['admin', 'super_admin'])) {
            return response()->json(['message' => 'You are not authorized to access this route'], 401);
        }

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
