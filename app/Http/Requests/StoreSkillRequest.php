<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'project_ids' => ['exists:projects,id']
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
            'project_ids.exists' => 'Uno o più dei progetti selezionati non sono validi.',
        ];
    }
}