<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'logo' => ['nullable', 'string', 'max:2048'],
            'website' => ['nullable', 'url', 'max:255'],
            'location_id' => ['required', 'integer', 'exists:locations,id'],
            'industry' => ['required', 'string', 'max:255'],
            'employees_count' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
