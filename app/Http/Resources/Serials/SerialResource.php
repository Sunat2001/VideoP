<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class SerialResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_cover' => $this->image_cover,
            'rate' => $this->rate,
            'attributes' => $this->attributeValues,
        ];
    }
}
