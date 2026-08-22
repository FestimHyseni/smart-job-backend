<?php

namespace App\Http\Requests\AiJobRecommendation;

use App\Enums\RecommendationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAiJobRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'required', Rule::enum(RecommendationStatus::class)],
        ];
    }
}
