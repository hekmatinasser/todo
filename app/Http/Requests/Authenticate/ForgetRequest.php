<?php

namespace App\Http\Requests\Authenticate;

use Illuminate\Foundation\Http\FormRequest;

class ForgetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email']
        ];
    }
}
