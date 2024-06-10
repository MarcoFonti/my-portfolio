<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'name' => ['required', 'min:3'],
            'skill_ids' => ['required','exists:skills,id'],
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
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'skill_ids.required' => 'Almeno una skill deve essere selezionata.',
            'skill_ids.exists' => 'Una o più delle skill selezionate non sono valide.',
        ];
    }
}