<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationRequest extends FormRequest
{
    private const ALLOWED_CATEGORIES = [
        'Szociális és humanitárius szervezetek',
        'Egészségügyi szervezetek',
        'Oktatási és tudományos szervezetek',
        'Környezetvédelmi szervezetek',
        'Emberi jogi és jogvédő szervezetek',
        'Kulturális és művészeti szervezetek',
        'Sport és szabadidős szervezetek',
        'Ifjúsági és közösségfejlesztő szervezetek',
        'Érdekvédelmi és szakmai szervezetek',
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => $this->isMethod('post')
                ? ['required', Rule::in(self::ALLOWED_CATEGORIES)]
                : ['sometimes', 'required', Rule::in(self::ALLOWED_CATEGORIES)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'bank_account' => 'nullable|string|max:50',
        ];
    }
}
