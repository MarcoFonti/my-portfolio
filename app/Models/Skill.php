<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /* VALORI DA ACCETTARE */
    protected $fillable = ['name', 'image'];


    /* RELAZIONE CON IL MODELLO PROJECT */
    public function projects()
    {
        /* MOLTE */
        return $this->belongsToMany(Project::class);
    }
}