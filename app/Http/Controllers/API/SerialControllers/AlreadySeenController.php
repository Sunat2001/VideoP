<?php

namespace App\Http\Controllers\API\SerialControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Serials\SerialEpisodeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlreadySeenController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function watched(Request $request, $id): JsonResponse
    {
        $user = $request->user();
        $user->seenEpisodes()->attach($id);

        return response()->json([
            'status' => 'success',
            'message' => __('frontend.already_seen.success_episode_added'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
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
            "status" => "success",
            "message" => __('frontend.already_seen.success_episode_list'),
            "episodes" => $episodes,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return AnonymousResourceCollection
     */
    public function listBySeason(Request $request, $id): AnonymousResourceCollection
    {
        $user = $request->user();

        $episodes = $user->seenEpisodes()->with('serialEpisodeVideos')->where('season_id', $id)->get();

        return SerialEpisodeResource::collection($episodes);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function checkWatched(Request $request, $id): JsonResponse
    {
        $user = $request->user();

        $episode = $user->seenEpisodes()->where('video_episode_id', $id)->first();

        if ($episode === null) {
            return response()->json([
                "message" => __('frontend.already_seen.error_check_watched'),
            ]);
        }

        return response()->json([
            "message" => __('frontend.already_seen.success_check_watched'),
            "episode" => new SerialEpisodeResource($episode),
        ]);
    }
}
