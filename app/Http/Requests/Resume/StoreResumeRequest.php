<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }
}
