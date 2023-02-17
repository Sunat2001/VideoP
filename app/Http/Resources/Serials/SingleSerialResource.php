<?php

namespace App\Http\Resources\Serials;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleSerialResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image,
            'rate'        => $this->rate,
            'attributes'  => $this->attribute_values,
        ];
    }
}
