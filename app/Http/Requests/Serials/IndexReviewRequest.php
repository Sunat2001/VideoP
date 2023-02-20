<?php

namespace App\Http\Requests\Serials;

use App\Enum\ReviewStatuses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['nullable', 'string', Rule::in(ReviewStatuses::getValues())]
        ];
    }
}
