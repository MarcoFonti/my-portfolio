<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory;

    /* ELIMINAZIONE SOFT */
    use SoftDeletes;

    /* VALORI DA ACCETTARE */
    protected $fillable = ['name', 'image'];


    /* RELAZIONE CON IL MODELLO PROJECT */
    public function projects()
    {
        /* MOLTE */
        return $this->belongsToMany(Project::class);
    }
}