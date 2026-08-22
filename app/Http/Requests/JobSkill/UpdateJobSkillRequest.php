<?php

namespace App\Http\Requests\JobSkill;

use App\Enums\SkillImportance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJobSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'importance' => ['sometimes', 'required', Rule::enum(SkillImportance::class)],
        ];
    }
}
