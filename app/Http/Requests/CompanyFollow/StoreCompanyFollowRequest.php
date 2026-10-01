<?php

namespace App\Http\Requests\CompanyFollow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyFollowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'company_id' => [
                'required',
                'integer',
                'exists:companies,id',
                Rule::unique('company_follows')->where('user_id', $this->input('user_id')),
            ],
        ];
    }
}
