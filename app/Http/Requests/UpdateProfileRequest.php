<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bio' => 'nullable|max:255',
            'date_of_birth' => 'nullable|date', 
            'avatar' => 'nullable|file|mimes:png,jpg,jpeg,webp'
        ];
    }
}
