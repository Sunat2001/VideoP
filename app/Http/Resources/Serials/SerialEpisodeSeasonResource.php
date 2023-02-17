<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class SerialEpisodeSeasonResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'season_number' => $this->season_number,
            'rate' => $this->rate,
            'is_final' => $this->is_final,
            'description' => $this->description,
            'serial' => new SerialResource($this->whenLoaded('serial')),
            'season_episodes' => SerialEpisodeResource::collection($this->whenLoaded('seasonEpisodes')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
