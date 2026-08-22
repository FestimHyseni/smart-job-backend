<?php

namespace App\Http\Requests\JobViewStats;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobViewStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'views_count' => ['sometimes', 'required', 'integer', 'min:0'],
        ];
    }
}
