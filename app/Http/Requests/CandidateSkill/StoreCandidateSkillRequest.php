<?php

namespace App\Http\Requests\CandidateSkill;

use App\Enums\SkillLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCandidateSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'skill_id' => [
                'required',
                'integer',
                'exists:skills,id',
                Rule::unique('candidate_skills')->where('user_id', $this->input('user_id')),
            ],
            'level' => ['required', Rule::enum(SkillLevel::class)],
            'verified' => ['sometimes', 'boolean'],
        ];
    }
}
