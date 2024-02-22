<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:190'],
            'description' => ['nullable']
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->can('update', $this->route('task'));
    }
}
