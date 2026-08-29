<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => [
                'required',
                'integer',
                'exists:jobs,id',
                Rule::unique('applications')->where('candidate_id', $this->input('candidate_id')),
            ],
            'candidate_id' => ['required', 'integer', 'exists:users,id'],
            'resume_id' => ['required', 'integer', 'exists:resumes,id'],
            'cover_letter' => ['nullable', 'string'],
            'experience_summary' => ['nullable', 'string'],
            'languages' => ['nullable', 'string', 'max:255'],
        ];
    }
}
