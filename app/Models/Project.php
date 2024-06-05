<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /* VALORI DA ACCETTARE */
    protected $fillable = ['name', 'image', 'project_url'];


    /* RELAZIONE CON IL MODELLO SKILL */
    public function skills()
    {
        /* MOLTE */
        return $this->belongsToMany(Skill::class);
    }
}