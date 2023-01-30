<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class SerialEpisodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'serial_number' => $this->serial_number,
            'rate' => $this->rate,
            'serial' => new SerialResource($this->serial),
            'season' => new SerialEpisodeSeasonResource($this->season),
            'serial_video' => SerialEpisodeVideoResource::collection($this->whenLoaded('serialEpisodeVideos')),
        ];
    }
}
