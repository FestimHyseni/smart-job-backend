<?php

namespace App\Http\Requests\CandidateLanguage;

use App\Enums\LanguageProficiency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCandidateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('candidate_languages')->where('user_id', $this->input('user_id')),
            ],
            'speaking' => ['required', Rule::enum(LanguageProficiency::class)],
            'writing' => ['required', Rule::enum(LanguageProficiency::class)],
            'listening' => ['required', Rule::enum(LanguageProficiency::class)],
            'understanding' => ['required', Rule::enum(LanguageProficiency::class)],
        ];
    }
}
