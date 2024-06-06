<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Projects/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* RECUPERO LE SKILLS */
        $skills = Skill::all();
        return Inertia::render('Projects/create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* VALIDAZIONE */
        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'skill_ids' => ['exists:skills,id'],

        ],[
            'image.required' => 'L\'immagine è obbligatoria.',
            'image.image' => 'Il file deve essere un\'immagine.',
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'skill_ids.exists' => 'Una o più delle skill selezionate non sono valide.',
        ]);

        /* CONTROLLO FILE IMAGE CARTELLA PROJECTS PER LE IMMAGINI */
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('projects');

            /* CREO E SALVO LA CHIAMATA */
            $project = Project::create([
                'name' => $request->name,
                'image' => $image,
                'project_url' => $request->project_url
            ]);

            /* CONTROLLO SE NELLA REQUEST ABBIAMO L'ARRAY DELLE SKILL E UTILIZZO IL METODO ATTACH PER ASSOCIARLI AL PROGETTO (CHECKBOX) */
            if (Arr::exists($request, 'skill_ids')) {
                $project->skills()->attach($request->skill_ids);
            }

            return Redirect::route('projects.index');
        }



        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}