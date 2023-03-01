<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OtpRequest;
use App\Models\VerificationCode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                'message' => __('auth.messages.error_invalid_otp'),
            ], 422);
        }

        if ($code->expire_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => __('auth.messages.error_expired_otp'),
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
            'message' => __('auth.messages.success_login'),
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
                'message' => __('auth.messages.error_invalid_otp'),
            ], 422);
        }

        if ($code->expire_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'message' => __('auth.messages.error_expired_otp'),
            ], 422);
        }

        $code->update([
            'can_password_reset' => true,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('auth.messages.success_otp_password'),
        ]);
    }

    private function getVerificationCodeByOtp($otp): Builder|Model|null
    {
        return VerificationCode::query()->where('otp', $otp)->first();
    }
}
