<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class CheckTwoFactorSecretRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
