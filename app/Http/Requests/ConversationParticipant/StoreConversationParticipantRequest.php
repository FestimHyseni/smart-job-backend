<?php

namespace App\Http\Requests\ConversationParticipant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConversationParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conversation_id' => ['required', 'integer', 'exists:conversations,id'],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('conversation_participants')->where('conversation_id', $this->input('conversation_id')),
            ],
        ];
    }
}
