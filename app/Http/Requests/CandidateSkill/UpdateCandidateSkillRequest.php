<?php

namespace App\Http\Requests\CandidateSkill;

use App\Enums\SkillLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCandidateSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'level' => ['sometimes', 'required', Rule::enum(SkillLevel::class)],
            'verified' => ['sometimes', 'boolean'],
        ];
    }
}
