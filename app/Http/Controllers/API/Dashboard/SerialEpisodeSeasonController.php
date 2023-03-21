<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialEpisodeSeasonRequest;
use App\Http\Resources\Serials\SerialEpisodeSeasonResource;
use App\Models\SerialEpisodeSeason;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class SerialEpisodeSeasonController extends Controller
{
    protected array $relations = [];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SerialEpisodeSeasonResource::collection(SerialEpisodeSeason::query()->paginate(15));
    }

    /**
     * @param SerialEpisodeSeasonRequest $request
     * @return JsonResponse
     */
    public function store(SerialEpisodeSeasonRequest $request): JsonResponse
    {
        $serialEpisodeSeason = SerialEpisodeSeason::query()->create($request->validated());

        return (new SerialEpisodeSeasonResource($serialEpisodeSeason))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param SerialEpisodeSeason $serialEpisodeSeason
     * @return JsonResponse
     */
    public function show(SerialEpisodeSeason $serialEpisodeSeason): JsonResponse
    {
        return (new SerialEpisodeSeasonResource($serialEpisodeSeason))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param SerialEpisodeSeasonRequest $request
     * @param SerialEpisodeSeason $serialEpisodeSeason
     * @return Response
     */
    public function update(SerialEpisodeSeasonRequest $request,SerialEpisodeSeason $serialEpisodeSeason): Response
    {
        $serialEpisodeSeason->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SerialEpisodeSeason $serialEpisodeSeason
     * @return Response
     */
    public function destroy(SerialEpisodeSeason $serialEpisodeSeason): Response
    {
        $serialEpisodeSeason->delete();

        return response()->noContent();
    }
}
