<?php

namespace App\Http\Requests\CandidateLanguage;

use App\Enums\LanguageProficiency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCandidateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('candidate_languages')->where('user_id', $this->route('candidate_language')?->user_id)->ignore($this->route('candidate_language')),
            ],
            'speaking' => ['sometimes', 'required', Rule::enum(LanguageProficiency::class)],
            'writing' => ['sometimes', 'required', Rule::enum(LanguageProficiency::class)],
            'listening' => ['sometimes', 'required', Rule::enum(LanguageProficiency::class)],
            'understanding' => ['sometimes', 'required', Rule::enum(LanguageProficiency::class)],
        ];
    }
}
