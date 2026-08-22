<?php

namespace App\Http\Requests\Job;

use App\Enums\EmploymentType;
use App\Enums\ExperienceLevel;
use App\Enums\JobStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['sometimes', 'required', 'integer', 'exists:companies,id'],
            'category_id' => ['sometimes', 'required', 'integer', 'exists:job_categories,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'requirements' => ['sometimes', 'required', 'string'],
            'location_id' => ['sometimes', 'required', 'integer', 'exists:locations,id'],
            'employment_type' => ['sometimes', Rule::enum(EmploymentType::class)],
            'experience_level' => ['sometimes', Rule::enum(ExperienceLevel::class)],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0'],
            'salary_currency' => ['sometimes', 'required', 'string', 'size:3'],
            'status' => ['sometimes', Rule::enum(JobStatus::class)],
            'deadline' => ['sometimes', 'required', 'date'],
        ];
    }
}
