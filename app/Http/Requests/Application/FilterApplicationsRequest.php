<?php

namespace App\Http\Requests\Application;

use App\Enums\ApplicationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterApplicationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'candidate_id' => ['sometimes', 'integer', 'exists:users,id'],
            'job_id' => ['sometimes', 'integer', 'exists:jobs,id'],
            'status' => ['sometimes', Rule::enum(ApplicationStatus::class)],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }
}
