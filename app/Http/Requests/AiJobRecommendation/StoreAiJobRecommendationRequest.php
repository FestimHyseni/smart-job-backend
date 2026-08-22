<?php

namespace App\Http\Requests\AiJobRecommendation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAiJobRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
            'match_score' => ['required', 'numeric', 'min:0', 'max:100'],
            'reason' => ['required', 'string'],
            'model_version' => ['required', 'string', 'max:50'],
        ];
    }
}
