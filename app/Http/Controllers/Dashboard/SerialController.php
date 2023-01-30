<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialRequest;
use App\Http\Resources\Serials\SerialResource;
use App\Models\Serial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class SerialController extends Controller
{
    protected array $relations = [];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SerialResource::collection(Serial::query()->paginate(15));
    }

    /**
     * @param SerialRequest $request
     * @return JsonResponse
     */
    public function store(SerialRequest $request): JsonResponse
    {
        $serial = Serial::query()->create($request->validated());

        // TODO: add attribute values to serial

        return (new SerialResource($serial))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param Serial $serial
     * @return JsonResponse
     */
    public function show(Serial $serial): JsonResponse
    {
        return (new SerialResource($serial))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param SerialRequest $request
     * @param Serial $serial
     * @return Response
     */
    public function update(SerialRequest $request,Serial $serial): Response
    {
        $serial->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Serial $serial
     * @return Response
     */
    public function destroy(Serial $serial): Response
    {
        $serial->delete();

        return response()->noContent();
    }
}
