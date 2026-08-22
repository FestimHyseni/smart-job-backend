<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'institution' => ['sometimes', 'required', 'string', 'max:255'],
            'degree' => ['sometimes', 'required', 'string', 'max:255'],
            'field' => ['sometimes', 'required', 'string', 'max:255'],
            'start_date' => ['sometimes', 'required', 'date'],
            'end_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
        ];
    }
}
