<?php

namespace App\Http\Requests\Dashboard;

use App\Enum\Languages;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => ['required', Rule::in(['on', 'off'])],
            'language' => ['required', Rule::in(Languages::getValues())],
        ];
    }
}
