<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        $otp = Str::random(6);

        VerificationCode::query()->create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expire_at' => now()->addDay(),
        ]);

        $this->dispatch(new SendWelcomeEmailJob($user->email, $otp));

        return response()->json([
            'status' => 'success',
            'message' => 'For activate your account, please check your email',
        ]);
    }
}
