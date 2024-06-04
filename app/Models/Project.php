<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /* VALORI DA ACCETTARE */
    protected $fillable = ['skill_id', 'name', 'image', 'project_url'];


    /* RELAZIONE CON IL MODELLO SKILL */
    public function skill()
    {
        /* MOLTE */
        return $this->belongsToMany(Skill::class);
    }
}