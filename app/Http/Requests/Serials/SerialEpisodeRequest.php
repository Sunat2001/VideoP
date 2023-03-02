<?php

namespace App\Http\Requests\Serials;

use App\Models\Serial;
use App\Models\SerialEpisodeSeason;
use App\Models\SerialEpisodeVideo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SerialEpisodeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'description' => ['required', 'array'],
            'description.*' => ['required', 'string', 'max:255'],
            'serial_number' => ['required', 'integer', 'min:1'],
            'rate' => ['required', 'numeric', 'min:1', 'max:10'],
            'serial_id' => ['required', 'integer', Rule::exists(Serial::class, 'id')],
            'season_id' => ['required', 'integer', Rule::exists(SerialEpisodeSeason::class, 'id')->where('serial_id', $this->serial_id)],
//            'serial_video_id' => ['required', 'array'],
//            'serial_video_id.*' => ['required', 'integer', Rule::exists(SerialEpisodeVideo::class, 'id')],
        ];
    }
}
