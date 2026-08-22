<?php

namespace App\Http\Requests\SavedJob;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSavedJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'job_id' => [
                'required',
                'integer',
                'exists:jobs,id',
                Rule::unique('saved_jobs')->where('user_id', $this->input('user_id')),
            ],
        ];
    }
}
