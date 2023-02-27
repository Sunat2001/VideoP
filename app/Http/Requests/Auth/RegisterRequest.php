<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
            'password' => ['required', 'string', 'min:8'],
            'image' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
