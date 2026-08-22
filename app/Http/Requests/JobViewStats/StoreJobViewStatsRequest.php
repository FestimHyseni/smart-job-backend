<?php

namespace App\Http\Requests\JobViewStats;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobViewStatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
            'date' => [
                'required',
                'date',
                Rule::unique('job_view_stats')->where('job_id', $this->input('job_id')),
            ],
            'views_count' => ['required', 'integer', 'min:0'],
        ];
    }
}
