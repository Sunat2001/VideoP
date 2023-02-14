<?php

namespace App\Http\Controllers\SerialControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GenerateRecommendedSerialsService;
use Illuminate\Http\Request;

class SerialRecommendedController extends Controller
{
    public function recommendations(Request $request)
    {
        $user = User::find(1);
        /** @var GenerateRecommendedSerialsService $generateRecommendedSerialsService */
        $generateRecommendedSerialsService = app(GenerateRecommendedSerialsService::class);

        $recommendedSerials = $generateRecommendedSerialsService->generate($user);

        return response()->json($recommendedSerials);
    }
}
