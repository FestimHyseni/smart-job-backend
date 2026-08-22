<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'type' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ];
    }
}
