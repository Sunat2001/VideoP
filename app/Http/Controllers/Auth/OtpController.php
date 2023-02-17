<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OtpRequest;
use App\Models\VerificationCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function checkOtp(OtpRequest $request): JsonResponse
    {
        $code = VerificationCode::query()->where('otp', $request->get('otp'))->first();

        if (!$code) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP',
            ], 422);
        }

        if ($code->expire_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired',
            ], 422);
        }

        $code->user->update([
            'email_verified_at' => now(),
        ]);

        $token = Auth::login($code->user);

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'code' => $code->user->only(['id', 'name', 'email', 'image']),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
}
