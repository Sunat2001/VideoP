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
            'episode' => new SerialEpisodeResource($this->serialEpisode),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
