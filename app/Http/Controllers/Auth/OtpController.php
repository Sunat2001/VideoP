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
    /**
     * @param OtpRequest $request
     * @return JsonResponse
     */
    public function checkOtp(OtpRequest $request): JsonResponse
    {
        $code = $this->getVerificationCodeByOtp($request->get('otp'));

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

        $code->update([
            'otp' => null,
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

    public function otpResetPassword(OtpRequest $request): JsonResponse
    {
        $code = $this->getVerificationCodeByOtp($request->get('otp'));

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

        $code->update([
            'can_password_reset' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password can be changed',
        ]);
    }

    private function getVerificationCodeByOtp($otp): VerificationCode|null
    {
        return VerificationCode::query()->where('otp', $otp)->first();
    }
}
