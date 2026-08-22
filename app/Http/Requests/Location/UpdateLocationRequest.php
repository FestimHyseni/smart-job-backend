<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => ['sometimes', 'required', 'string', 'max:255'],
            'country' => ['sometimes', 'required', 'string', 'max:255'],
        ];
    }
}
