<?php

namespace App\Http\Requests\Job;

use App\Enums\EmploymentType;
use App\Enums\ExperienceLevel;
use App\Enums\JobStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'category_id' => ['required', 'integer', 'exists:job_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'employment_type' => ['required', Rule::enum(EmploymentType::class)],
            'experience_level' => ['required', Rule::enum(ExperienceLevel::class)],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'salary_currency' => ['required', 'string', 'size:3'],
            'status' => ['sometimes', Rule::enum(JobStatus::class)],
            'deadline' => ['required', 'date', 'after:today'],
        ];
    }
}
