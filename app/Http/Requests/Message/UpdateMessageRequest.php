<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'read_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
