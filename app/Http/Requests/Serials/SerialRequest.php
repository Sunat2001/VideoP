<?php

namespace App\Http\Requests\Serials;

use App\Models\AttributeValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SerialRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'description' => ['required', 'array'],
            'description.*' => ['required', 'string', 'max:255'],
            'image_cover' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'numeric', 'min:0', 'max:10'],
            'attribute_values' => ['required', 'array'],
            'attribute_values.*' => ['required', 'int', Rule::exists(AttributeValue::class, 'id')],
        ];
    }
}
