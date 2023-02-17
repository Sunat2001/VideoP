<?php

namespace App\Http\Resources\Serials;

use Illuminate\Http\Resources\Json\JsonResource;

class SerialEpisodeVideoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'video_url' => $this->video_url,
            'format' => $this->format,
            'quality' => $this->quality,
            'duration' => $this->duration,
            'episode' => new SerialEpisodeResource($this->whenLoaded('serialEpisode')),
        ];
    }
}
