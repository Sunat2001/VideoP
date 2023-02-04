<?php

namespace App\Http\Requests\Serials;

use Illuminate\Foundation\Http\FormRequest;

class SerialByAttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}
