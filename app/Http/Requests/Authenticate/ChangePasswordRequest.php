<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'current'               => ['required', 'current_password'],
            'password'              => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
