<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['sometimes', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }
}
