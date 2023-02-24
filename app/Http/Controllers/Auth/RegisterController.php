<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()->create($request->validated());
        } catch (QueryException $e) {
            // Catch the "Integrity constraint violation: 1062 Duplicate entry" exception
            if ($e->errorInfo[1] == 1062) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('auth.messages.error_email_already_exists'),
                    ], 400);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => __('transaction.error_insert_data'),
                ], 500);
            }
        }

        $otp = Str::random(6);

        VerificationCode::query()->create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expire_at' => now()->addDay(),
        ]);

        $this->dispatch(new SendWelcomeEmailJob($user->email, $otp));

        return response()->json([
            'status' => 'error',
            'message' => __('auth.messages.success_register'),
        ]);
    }
}
