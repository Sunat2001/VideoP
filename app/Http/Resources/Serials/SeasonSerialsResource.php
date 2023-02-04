<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonSerialsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'serial_episodes' => SerialEpisodeResource::collection($this->serialEpisodes),
        ];
    }
}
