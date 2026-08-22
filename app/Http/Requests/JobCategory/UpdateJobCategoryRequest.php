<?php

namespace App\Http\Requests\JobCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes', 'required', 'string', 'max:255',
                Rule::unique('job_categories', 'name')->ignore($this->route('jobCategory')),
            ],
        ];
    }
}
