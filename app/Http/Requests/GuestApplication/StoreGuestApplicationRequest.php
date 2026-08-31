<?php

namespace App\Http\Requests\GuestApplication;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['required', 'integer', 'exists:jobs,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'cover_letter' => ['nullable', 'string'],
            'experience_summary' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'job_id.required' => 'Pozita e punës mungon.',
            'job_id.exists' => 'Kjo pozitë pune nuk ekziston.',
            'first_name.required' => 'Emri është i detyrueshëm.',
            'last_name.required' => 'Mbiemri është i detyrueshëm.',
            'email.required' => 'Email-i është i detyrueshëm.',
            'email.email' => 'Email-i nuk është i vlefshëm.',
            'resume.required' => 'CV-ja është e detyrueshme.',
            'resume.mimes' => 'CV-ja duhet të jetë PDF, DOC ose DOCX.',
            'resume.max' => 'CV-ja nuk duhet të kalojë 10 MB.',
        ];
    }
}
