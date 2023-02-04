<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SearchRequest;
use App\Http\Resources\Serials\SerialResource;
use App\Models\Serial;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    public function search(SearchRequest $request): AnonymousResourceCollection
    {
        $search = $request->get('search');

        $serials = Serial::query()
            ->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");

        if ($attributes = $request->get('attributes')) {
            $serials->whereHas('attributeValues', function ($query) use ($attributes) {
                $query->whereIn('attribute_values.id', $attributes);
            });
        }

        return SerialResource::collection($serials->paginate($request->get('per_page')));
    }
}
