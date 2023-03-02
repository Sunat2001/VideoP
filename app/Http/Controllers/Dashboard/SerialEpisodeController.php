<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialEpisodeRequest;
use App\Http\Resources\Serials\SerialEpisodeResource;
use App\Models\SerialEpisode;
use App\Models\SerialEpisodeVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class SerialEpisodeController extends Controller
{
    protected array $relations = [
        'serial',
        'season',
        'serialEpisodeVideos',
    ];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SerialEpisodeResource::collection(SerialEpisode::query()->with($this->relations)->paginate(15));
    }

    /**
     * @param SerialEpisodeRequest $request
     * @return JsonResponse
     */
    public function store(SerialEpisodeRequest $request): JsonResponse
    {
        $serialEpisode = SerialEpisode::query()->create($request->validated());

        return (new SerialEpisodeResource($serialEpisode->load($this->relations)))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param SerialEpisode $serialEpisode
     * @return JsonResponse
     */
    public function show(SerialEpisode $serialEpisode): JsonResponse
    {
        return (new SerialEpisodeResource($serialEpisode))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param SerialEpisodeRequest $request
     * @param SerialEpisode $serialEpisode
     * @return Response
     */
    public function update(SerialEpisodeRequest $request,SerialEpisode $serialEpisode): Response
    {
        $serialEpisode->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SerialEpisode $serialEpisode
     * @return Response
     */
    public function destroy(SerialEpisode $serialEpisode): Response
    {
        $serialEpisode->delete();

        return response()->noContent();
    }
}
