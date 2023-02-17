<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'new_password' => ['required', 'string', 'min:8'],
        ];
    }
}
