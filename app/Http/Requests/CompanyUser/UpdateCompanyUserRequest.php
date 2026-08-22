<?php

namespace App\Http\Requests\CompanyUser;

use App\Enums\CompanyUserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['sometimes', 'required', Rule::enum(CompanyUserRole::class)],
        ];
    }
}
