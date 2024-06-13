<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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

        /* VALIDAZIONE */
        return [
            'name' => ['required' ,'min:3'],
            'email' => ['required', 'email'],
            'body' => ['required']
        ];
    }

    /**
     * Ottiene i messaggi di errore personalizzati per le regole di validazione.
     *
     * @return array
     */
    public function messages()
    {
        /* MESSAGGIO */
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.min' => 'Il campo nome deve essere lungo almeno :min caratteri.',
            'email.required' => 'Il campo email è obbligatorio.',
            'email.email' => 'Inserisci un indirizzo email valido.',
            'body.required' => 'Il campo messaggio è obbligatorio.',
        ];
    }
}