<?php

namespace App\Http\Requests\Resume;

use App\Models\Resume;
use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
                function ($attribute, $value, $fail): void {
                    $alreadyUploaded = Resume::where('user_id', $this->input('user_id'))
                        ->where('file_name', $value->getClientOriginalName())
                        ->exists();

                    if ($alreadyUploaded) {
                        $fail('You have already uploaded a document with this name.');
                    }
                },
            ],
            'is_default' => ['sometimes', 'boolean'],
        ];
    }
}
