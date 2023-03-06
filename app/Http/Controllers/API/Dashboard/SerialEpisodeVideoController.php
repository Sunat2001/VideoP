<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialEpisodeVideoRequest;
use App\Http\Resources\Serials\SerialEpisodeVideoResource;
use App\Models\SerialEpisodeVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class SerialEpisodeVideoController extends Controller
{
    protected array $relations = [];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SerialEpisodeVideoResource::collection(SerialEpisodeVideo::query()->paginate(15));
    }

    /**
     * @param SerialEpisodeVideoRequest $request
     * @return JsonResponse
     */
    public function store(SerialEpisodeVideoRequest $request): JsonResponse
    {
        $SerialEpisodeVideo = SerialEpisodeVideo::query()->create($request->validated());

        return (new SerialEpisodeVideoResource($SerialEpisodeVideo))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param SerialEpisodeVideo $SerialEpisodeVideo
     * @return JsonResponse
     */
    public function show(SerialEpisodeVideo $SerialEpisodeVideo): JsonResponse
    {
        return (new SerialEpisodeVideoResource($SerialEpisodeVideo))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param SerialEpisodeVideoRequest $request
     * @param SerialEpisodeVideo $SerialEpisodeVideo
     * @return Response
     */
    public function update(SerialEpisodeVideoRequest $request,SerialEpisodeVideo $SerialEpisodeVideo): Response
    {
        $SerialEpisodeVideo->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SerialEpisodeVideo $SerialEpisodeVideo
     * @return Response
     */
    public function destroy(SerialEpisodeVideo $SerialEpisodeVideo): Response
    {
        $SerialEpisodeVideo->delete();

        return response()->noContent();
    }
}
