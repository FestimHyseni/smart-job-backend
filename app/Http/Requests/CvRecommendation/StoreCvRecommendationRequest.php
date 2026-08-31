<?php

namespace App\Http\Requests\CvRecommendation;

use Illuminate\Foundation\Http\FormRequest;

class StoreCvRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cv' => ['required', 'file', 'mimes:pdf,docx', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'cv.required' => 'CV-ja është e detyrueshme.',
            'cv.mimes' => 'CV-ja duhet të jetë PDF ose DOCX.',
            'cv.max' => 'CV-ja nuk duhet të kalojë 10 MB.',
        ];
    }
}
