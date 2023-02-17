<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'      =>  ['required', 'array'],
            'name.*'    => ['required', 'string', 'max:255'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
