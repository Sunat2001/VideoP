<?php

namespace App\Http\Requests\Serials;

use App\Models\Serial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SerialEpisodeSeasonRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'season_number' => ['required', 'integer', 'min:1'],
            'rate' => ['required', 'numeric', 'min:1', 'max:10'],
            'year' => ['required', 'integer', 'min:1900', 'max:'.date('Y')],
            'is_final' => ['required', 'boolean'],
            'description' => ['required', 'array'],
            'description.*' => ['required', 'string', 'max:255'],
            'serial_id' => ['required', 'integer', Rule::exists(Serial::class, 'id')],
        ];
    }
}
