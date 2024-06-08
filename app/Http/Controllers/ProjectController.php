<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
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
        /* RECUPERO VALORI MANIPOLATI DALLE RISORSE, E UTILIZZO IL METODO 'WITH' PER RECUPERARE I VALORI DELLA RELAZIONE CON LE SKILLS */
        $projects = ProjectResource::collection(Project::with('skills')->get());
        
        /* VISTA PER I PROGETTI */
        return Inertia::render('Projects/index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* RECUPERO LE SKILLS */
        $skills = Skill::all();
        
        /* VISTA PER LA CREAZIONE */
        return Inertia::render('Projects/create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        /* CONTROLLO FILE IMAGE E CREO CARTELLA PROJECTS PER LE IMMAGINI */
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

            /* REINDIRIZZO ALLA ROTTA INDEX */
            return Redirect::route('projects.index');
        }

        /* REINDIRIZZO ALLA ROTTA PRECEDENTE */
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