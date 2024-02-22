<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'code'  => ['required']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
