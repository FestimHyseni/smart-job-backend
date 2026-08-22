<?php

namespace App\Http\Requests\JobView;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
