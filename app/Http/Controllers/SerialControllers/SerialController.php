<?php

namespace App\Http\Controllers\SerialControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Serials\SerialByAttributeRequest;
use App\Http\Requests\Serials\TopSerialsRequest;
use App\Http\Resources\Serials\SeasonSerialsResource;
use App\Http\Resources\Serials\SerialResource;
use App\Http\Resources\Serials\SingleSerialResource;
use App\Http\Resources\Serials\TopSerialsResource;
use App\Models\AttributeValue;
use App\Models\Serial;
use App\Models\SerialEpisode;
use App\Models\SerialEpisodeSeason;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SerialController extends Controller
{
    /**
     * @param TopSerialsRequest $request
     * @return AnonymousResourceCollection
     */
    public function topSerials(TopSerialsRequest $request): AnonymousResourceCollection
    {
        return TopSerialsResource::collection(Serial::query()->withCount('serialEpisodeSeasons')
            ->orderBy($request->get('order_by'), 'desc')
            ->paginate($request->get('per_page')));
    }

    /**
     * @param Serial $serial
     * @return SerialResource
     */
    public function serialById(Serial $serial): SerialResource
    {
        $serial->load('attributeValues.attribute');

        $serial->attribute_values = $serial->attributeValues->groupBy('attribute.name');

        foreach ($serial->attribute_values as $value) {
            $value->transform(function ($item) {
                return $item->only(['id', 'name']);
            });
        }

        return new SerialResource($serial);
    }

    /**
     * Выводить все серии сезона
     *
     * @param SerialEpisodeSeason $season
     * @return SingleSerialResource
     */
    public function serialsBySeason(SerialEpisodeSeason $season): mixed
    {
        $season->load('serialEpisodes.serialEpisodeVideos');

        return new SeasonSerialsResource($season);
    }

    /**
     * @param SerialByAttributeRequest $request
     * @param AttributeValue $attributeValue
     * @return mixed
     */
    public function serialByAttributeValue(SerialByAttributeRequest $request, AttributeValue $attributeValue): AnonymousResourceCollection
    {
        return SerialResource::collection(Serial::query()->whereHas('attributeValues', function ($query) use ($attributeValue) {
            $query->where('attribute_values.id', $attributeValue->id);
        })->paginate($request->get('per_page')));
    }




}
