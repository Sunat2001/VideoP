<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Jobs\ResetPasswordJob;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * @param PasswordResetRequest $request
     * @return JsonResponse
     */
    public function reset(PasswordResetRequest $request): JsonResponse
    {
        $code = VerificationCode::query()->with('user')->whereHas('user', function ($query) use ($request) {
            $query->where('email', $request->get('email'));
        })
            ->where('expire_at', '>', now())
            ->where('can_password_reset', true)
            ->first();

        if (!$code) {
            return response()->json([
                'status' => 'error',
                'message' => 'Confirm otp first',
            ], 422);
        }

        $user = $code->user;

        $user->update([
            'password' => $request->get('new_password'),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Password reset successfully',
            'code' => $user->only(['id', 'name', 'email', 'image']),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $code = VerificationCode::query()->where('user_id', $user->id)
            ->where('otp', null)
            ->where('expire_at', '>', now())
            ->first();

        if ($code) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP already sent',
            ], 422);
        }

        $code = VerificationCode::query()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
            'user_id' => $user->id,
            'otp' => Str::random(6),
            'expire_at' => now()->addDay(),
        ]);

        $this->dispatch(new ResetPasswordJob($user->email, $code->otp));

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully',
        ]);
    }


}
