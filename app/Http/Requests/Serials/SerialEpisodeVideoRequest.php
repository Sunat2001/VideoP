<?php

namespace App\Http\Requests\Serials;

use App\Models\SerialEpisode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SerialEpisodeVideoRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'quality' => ['required', Rule::in(['120', '240', '360', '480', '720', '1080'])],
            'format' => ['required', Rule::in(['mp4', 'mkv', 'avi', 'flv', 'wmv', 'mov', 'mpeg', 'mpg'])],
            'video_url' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string'],
            'serial_episode_id' => ['required', 'integer', Rule::exists(SerialEpisode::class, 'id')],
        ];
    }
}
