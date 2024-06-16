<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {

        /* RECUPERO TUTTE LE SKILL NELLA RISORSA */
        $skills = SkillResource::collection(Skill::all());

        /* RECUPERO VALORI MANIPOLATI DALLE RISORSE, E UTILIZZO IL METODO 'WITH' PER RECUPERARE I VALORI DELLA RELAZIONE CON LE SKILLS */
        $projects = ProjectResource::collection(Project::with('skills')->orderBy('created_at', 'desc')->get());

        /* ROTTE LOGIN E REGISTRAIONE */
        $canLogin = Route::has('login');
        $canRegister = Route::has('register');

        /* RESTITUISCO ALLA PAGINA WELCOME */
        return Inertia::render('Welcome', compact('skills', 'canLogin', 'canRegister', 'projects'));
    }
}