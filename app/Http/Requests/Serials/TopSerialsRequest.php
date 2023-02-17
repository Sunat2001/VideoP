<?php

namespace App\Http\Requests\Serials;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopSerialsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'order_by' => ['required', Rule::in(['rate', 'created_at'])],
            'per_page' => ['required', 'integer'],
        ];
    }
}
