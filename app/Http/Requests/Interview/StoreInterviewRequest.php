<?php

namespace App\Http\Requests\Interview;

use App\Enums\InterviewType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInterviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'application_id' => ['required', 'integer', 'exists:applications,id'],
            'scheduled_at' => ['required', 'date'],
            'type' => ['required', Rule::enum(InterviewType::class)],
            'location' => ['nullable', 'string', 'max:255', 'required_if:type,physical'],
            'meeting_url' => ['nullable', 'url', 'max:255', 'required_if:type,online'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
