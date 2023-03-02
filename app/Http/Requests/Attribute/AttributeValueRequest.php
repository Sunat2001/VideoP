<?php

namespace App\Http\Requests\Attribute;

use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeValueRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.*' => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
            'image' => ['nullable', 'string'],
            'attribute_id' => ['required', 'integer', Rule::exists(Attribute::class, 'id')],
        ];
    }
}
