<?php

namespace App\Http\Controllers\API\Auth;

use App\Enum\LogChannelNames;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
            Log::channel(LogChannelNames::AUTH_ERROR)->error($e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => __('transaction.error_insert_data'),
            ], 500);
        }

        $otp = Str::random(6);

        VerificationCode::query()->create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expire_at' => now()->addDay(),
        ]);

        $this->dispatch(new SendWelcomeEmailJob($user->email, $otp));

        return response()->json([
            'status' => 'success',
            'message' => __('auth.messages.success_register'),
        ]);
    }
}
