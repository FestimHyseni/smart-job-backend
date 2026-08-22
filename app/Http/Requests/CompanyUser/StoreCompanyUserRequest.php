<?php

namespace App\Http\Requests\CompanyUser;

use App\Enums\CompanyUserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::unique('company_user')->where('company_id', $this->input('company_id')),
            ],
            'role' => ['required', Rule::enum(CompanyUserRole::class)],
        ];
    }
}
