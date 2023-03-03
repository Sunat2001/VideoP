<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\AttributeRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class AttributeController extends Controller
{
    protected array $relations = [];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AttributeResource::collection(Attribute::query()->with()->paginate(15));
    }

    /**
     * @param AttributeRequest $request
     * @return JsonResponse
     */
    public function store(AttributeRequest $request): JsonResponse
    {
        $Attribute = Attribute::query()->create($request->validated());

        return (new AttributeResource($Attribute))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param Attribute $attribute
     * @return JsonResponse
     */
    public function show(Attribute $attribute): JsonResponse
    {
        return (new AttributeResource($attribute))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param AttributeRequest $request
     * @param Attribute $attribute
     * @return Response
     */
    public function update(AttributeRequest $request,Attribute $attribute): Response
    {
        $attribute->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return Response
     */
    public function destroy(Attribute $attribute): Response
    {
        $attribute->delete();

        return response()->noContent();
    }
}
