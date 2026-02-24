<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EventRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'prohibited',
            'capacity' => 'required|integer|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Az esemény címe kötelező.',
            'title.string' => 'Az esemény címe szövegnek kell lennie.',
            'title.max' => 'Az esemény címe maximum 255 karakter lehet.',
            
            'description.required' => 'Az esemény leírása kötelező.',
            'description.string' => 'Az esemény leírása szövegnek kell lennie.',
            
            'location.required' => 'Az esemény helyszíne kötelező.',
            'location.string' => 'Az esemény helyszíne szövegnek kell lennie.',
            'location.max' => 'Az esemény helyszíne maximum 255 karakter lehet.',
            
            'date.required' => 'Az esemény dátuma kötelező.',
            'date.date' => 'Az esemény dátuma érvénytelen formátumú.',
            
            'status.prohibited' => 'A státuszt nem lehet megadni; a rendszer automatikusan számolja a dátum alapján.',
            
            'capacity.required' => 'Az esemény kapacitása kötelező.',
            'capacity.integer' => 'Az esemény kapacitása egész számnak kell lennie.',
            'capacity.min' => 'Az esemény kapacitása legalább 1 kell, hogy legyen.',
        ];
    }
}
