<?php

namespace App\Http\Requests\CandidateProfile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'headline' => ['sometimes', 'required', 'string', 'max:255'],
            'bio' => ['sometimes', 'required', 'string'],
            'location_id' => ['sometimes', 'required', 'integer', 'exists:locations,id'],
            'years_experience' => ['sometimes', 'required', 'integer', 'min:0'],
            'expected_salary' => ['sometimes', 'required', 'numeric', 'min:0'],
            'salary_currency' => ['sometimes', 'required', 'string', 'size:3'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
        ];
    }
}
