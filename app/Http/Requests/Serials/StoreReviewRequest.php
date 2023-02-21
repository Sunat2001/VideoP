<?php

namespace App\Http\Requests\Serials;

use App\Models\Serial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
{

    public function rules()
    {
        return [
            'serial_id' => ['required', 'integer', Rule::exists(Serial::class, 'id')],
            'text' => ['required', 'string'],
        ];
    }
}
