<?php

namespace App\Http\Controllers\SerialControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Serials\TopSerialsResource;
use App\Models\User;
use App\Services\GenerateRecommendedSerialsService;
use Illuminate\Http\Request;

class SerialRecommendedController extends Controller
{
    public function recommendations(Request $request)
    {
        /** @var GenerateRecommendedSerialsService $generateRecommendedSerialsService */
        $generateRecommendedSerialsService = app(GenerateRecommendedSerialsService::class);

        $recommendedSerials = $generateRecommendedSerialsService->generate($request->user(), $request->get('per_page', 10));

        return TopSerialsResource::collection($recommendedSerials);
    }
}
