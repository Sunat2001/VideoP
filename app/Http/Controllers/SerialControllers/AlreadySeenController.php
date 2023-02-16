<?php

namespace App\Http\Controllers\SerialControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Serials\SerialEpisodeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlreadySeenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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

        $episodes = $user->seenEpisodes()->with([
            'season',
            'serialEpisodeVideos',
        ])->get()->groupBy('season.season_number');

        foreach ($episodes as $episode) {
            $episode->transform(function ($item) {
                return $item->only([
                    'id',
                    'name',
                    'description',
                    'serial_number',
                    'rate',
                    'serialEpisodeVideos',
                ]);
            });
        }

        return response()->json([
            "message" => "List of watched episodes",
            "episodes" => $episodes,
        ]);
    }

    public function listBySeason(Request $request, $id): AnonymousResourceCollection
    {
        $user = $request->user();

        $episodes = $user->seenEpisodes()->with('serialEpisodeVideos')->where('season_id', $id)->get();

        return SerialEpisodeResource::collection($episodes);
    }

    public function checkWatched(Request $request, $id): JsonResponse
    {
        $user = $request->user();

        $episode = $user->seenEpisodes()->where('video_episode_id', $id)->first();

        if ($episode === null) {
            return response()->json([
                "message" => "Episode is not watched",
            ]);
        }

        return response()->json([
            "message" => "Episode is watched",
            "episode" => new SerialEpisodeResource($episode),
        ]);
    }
}
