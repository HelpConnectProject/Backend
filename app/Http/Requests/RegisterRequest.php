<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required_with:password|string|min:6',
            'phone' => 'nullable|string|max:150|unique:users,phone',
            'city' => 'nullable|string|max:100',
            'about' => 'nullable|string',

            // Opcionális qualification mezők regisztrációnál
            'interest' => 'nullable|string',
            'qualification' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A név mező kitöltése kötelező.',
            'name.max' => 'A név legfeljebb 100 karakter lehet.',

            'email.required' => 'Az e-mail mező kitöltése kötelező.',
            'email.email' => 'Érvényes e-mail címet adj meg.',
            'email.max' => 'Az e-mail legfeljebb 150 karakter lehet.',
            'email.unique' => 'Ezzel az e-mail címmel már regisztráltak.',

            'password.required' => 'A jelszó mező kitöltése kötelező.',
            'password.min' => 'A jelszónak legalább 6 karakter hosszúnak kell lennie.',
            'password.confirmed' => 'A jelszó megerősítése nem egyezik.',

            'password_confirmation.required_with' => 'A jelszó megerősítése kötelező.',
            'password_confirmation.min' => 'A jelszó megerősítésének legalább 6 karakter hosszúnak kell lennie.',

            'phone.max' => 'A telefonszám legfeljebb 150 karakter lehet.',
            'phone.unique' => 'Ezzel a telefonszámmal már regisztráltak.',

            'city.max' => 'A város neve legfeljebb 100 karakter lehet.',

            'qualification.max' => 'A végzettség legfeljebb 255 karakter lehet.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Adatbeviteli hiba',
            'data' => $validator->errors(),
        ], 422));
    }
}
