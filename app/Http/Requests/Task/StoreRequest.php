<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return auth()->user()->can('create', Task::class);
    }
}
