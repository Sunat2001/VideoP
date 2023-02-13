<?php

namespace App\Http\Controllers\SerialControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Serials\SerialEpisodeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlreadySeenController extends Controller
{
    public function watched(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        $user->seenEpisodes()->attach($id);

        return response()->json([
            "message" => "Episode added to watched list",
        ]);
    }

    public function list(Request $request): JsonResponse
    {
        $user = $request->user();
        $episodes = $user->seenEpisodes()->load('season')->groupBy('season_id');

        return response()->json([
            "message" => "List of watched episodes",
            "episodes" => $episodes,
        ]);
    }

    public function listBySeason(Request $request, $id): AnonymousResourceCollection
    {
        $user = $request->user();
        $episodes = $user->seenEpisodes()->where('season_id', $id)->get();

        return SerialEpisodeResource::collection($episodes);
    }
}
