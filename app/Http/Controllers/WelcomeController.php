<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
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

        /* ROTTE LOGIN E REGISTRAIONE */
        $canLogin = Route::has('login');
        $canRegister = Route::has('register');

        /* RESTITUISCO ALLA PAGINA WELCOME */
        return Inertia::render('Welcome', compact('skills', 'canLogin', 'canRegister'));
    }
}