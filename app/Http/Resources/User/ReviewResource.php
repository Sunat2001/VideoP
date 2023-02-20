<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'status' => $this->status,
            'positive' => $this->positive,
            'negative' => $this->negative,
            'serial' => $this->serial->only(['id', 'name']),
            'user' => $this->user->only(['id', 'name'])
        ];
    }
}
