<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
