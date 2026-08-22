<?php

namespace App\Http\Requests\JobSkill;

use App\Enums\SkillImportance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
            'skill_id' => [
                'required',
                'integer',
                'exists:skills,id',
                Rule::unique('job_skills')->where('job_id', $this->input('job_id')),
            ],
            'importance' => ['required', Rule::enum(SkillImportance::class)],
        ];
    }
}
