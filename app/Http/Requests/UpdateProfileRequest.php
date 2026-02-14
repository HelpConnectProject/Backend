<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'filled', 'string', 'max:255'],
            'phone' => ['sometimes', 'filled', 'string', 'max:50'],
            'city' => ['sometimes', 'filled', 'string', 'max:255'],
            'about' => ['sometimes', 'filled', 'string', 'max:2000'],
        ];
    }
}
