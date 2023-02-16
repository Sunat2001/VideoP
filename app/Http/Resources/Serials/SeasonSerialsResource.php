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
            'is_final' => $this->is_final,
            'season_number' => $this->season_number,
            'year' => $this->year,
            'rate' => $this->rate,
            'serial_episodes' => SerialEpisodeResource::collection($this->serialEpisodes),
        ];
    }
}
