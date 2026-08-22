<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversation_id' => ['required', 'integer', 'exists:conversations,id'],
            'sender_id' => ['required', 'integer', 'exists:users,id'],
            'message' => ['required', 'string'],
        ];
    }
}
