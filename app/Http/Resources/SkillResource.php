<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        /* VALORI RECUPERATI DAL DB */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset('storage/' . $this->image), // METODO PER GENERARE URL MEMORIZZATO NELLO STORAGE
            'projects' => $this->projects->select('id', 'name') // RECUPERO ID, NAME DEI PROJECTS
        ];
    }
}