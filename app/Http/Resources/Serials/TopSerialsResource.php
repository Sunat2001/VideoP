<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class TopSerialsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_cover' => $this->image_cover,
            'rate' => $this->rate,
            'seasons_count' => $this->serial_episode_seasons_count,
        ];
    }
}
