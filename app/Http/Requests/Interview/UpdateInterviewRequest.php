<?php

namespace App\Http\Requests\Interview;

use App\Enums\InterviewStatus;
use App\Enums\InterviewType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scheduled_at' => ['sometimes', 'required', 'date'],
            'type' => ['sometimes', Rule::enum(InterviewType::class)],
            'location' => ['nullable', 'string', 'max:255'],
            'meeting_url' => ['nullable', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', Rule::enum(InterviewStatus::class)],
        ];
    }
}
