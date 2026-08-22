<?php

namespace App\Http\Requests\CandidateProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreCandidateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'headline' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string'],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'years_experience' => ['required', 'integer', 'min:0'],
            'expected_salary' => ['required', 'numeric', 'min:0'],
            'salary_currency' => ['required', 'string', 'size:3'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
        ];
    }
}
