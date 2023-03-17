<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attribute\AttributeValueRequest;
use App\Http\Resources\Attribute\AttributeValueResource;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseConstants;

class AttributeValueController extends Controller
{
    protected array $relations = [];

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AttributeValueResource::collection(AttributeValue::query()->paginate(15));
    }

    /**
     * @param AttributeValueRequest $request
     * @return JsonResponse
     */
    public function store(AttributeValueRequest $request): JsonResponse
    {
        $attributeValue = AttributeValue::query()->create($request->validated());

        return (new AttributeValueResource($attributeValue))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_CREATED);
    }

    /**
     * @param AttributeValue $attributeValue
     * @return JsonResponse
     */
    public function show(AttributeValue $attributeValue): JsonResponse
    {
        return (new AttributeValueResource($attributeValue))
            ->response()
            ->setStatusCode(ResponseConstants::HTTP_OK);
    }

    /**
     * @param AttributeValueRequest $request
     * @param AttributeValue $attributeValue
     * @return Response
     */
    public function update(AttributeValueRequest $request,AttributeValue $attributeValue): Response
    {
        $attributeValue->update($request->validated());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AttributeValue $attributeValue
     * @return Response
     */
    public function destroy(AttributeValue $attributeValue): Response
    {
        $attributeValue->delete();

        return response()->noContent();
    }
}
