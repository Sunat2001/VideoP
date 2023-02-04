<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'search' => ['required', 'string', 'min:3', 'max:255'],
            'per_page' => ['required', 'integer', 'min:1', 'max:100'],
            'attributes' => ['nullable', 'array'],
            'attributes.*' => ['integer', Rule::exists('attribute_values', 'id')],
        ];
    }

}
