<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at === null) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('auth.messages.email_not_verified'),
                ], 401);
            }

            $token = Auth::user()->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => __('auth.messages.success_login'),
                'user' => Auth::user()->only(['id', 'name', 'email', 'image']),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => __('auth.messages.error_credentials'),
        ], 401);
    }
}
