<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
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
        
        /* CREO E SALVO LA CHIAMATA */
        $project = Project::create([
            'name' => $request->name,
            'project_url' => $request->project_url
        ]);

        /* CONTROLLO SE NELLA REQUEST ABBIAMO L'ARRAY DELLE SKILL E UTILIZZO IL METODO ATTACH PER ASSOCIARLI AL PROGETTO (CHECKBOX) */
        if (Arr::exists($request, 'skill_ids')) {
            $project->skills()->attach($request->skill_ids);
        }

        /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO */
        return Redirect::route('projects.index')->with('message', 'Progetto ' . $project->name . ' creato')->with('type', 'store');
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
        /* CERCO UN PROGETTO CON ID SPECIFICO E UTILIZZO IL METODO 'WITH' PER CARICARE LE SKILL ASSOCCIATI */
        $project = Project::with('skills')->findOrFail($id);

        /* RECUEPRO TUTTE LE SKILL */
        $skills = Skill::all();

        /* ESTRAGGO GLI ID DELLE SKILL ASSOCIATI AL PROGETTO E SALVO IN UN ARRAY */
        $project->skill_ids = $project->skills->pluck('id')->toArray();

        /* VISTA PER IL MODIFICA */
        return Inertia::render('Projects/edit', compact('skills', 'project',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        /* AGGIORNO I VALORI DEI PROGETTI */
        $project->update([
            'name' => $request->name,
            'project_url' => $request->project_url,
        ]);

        /* RIMUOVO E AGGIUNGO LE SKILL IN BASE ALLA RICHIESTA INVITA */
        $project->skills()->sync($request->skill_ids);

        /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO  */
        return Redirect::route('projects.index')->with('message', 'Progetto ' . $project->name . ' modificato')->with('type', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        /* ELIMINO PROGETTO */
        $project->delete();

        /* REINDIRIZZO ALLA ROTTA PRECEDENTE, CON UN MESSAGGIO */
        return Redirect::back()->with('message', 'Progetto ' . $project->name . ' messo nel cestino')->with('type', 'destroy');
    }

    /* CESTINO */
    public function trash()
    {
        /* RECUPERO TUTTI I PROGETTI ELIMINATI */
        $projects = Project::onlyTrashed()->with('skills')->get();

        /* VISTA PROGETTI CESTINATI */
        return Inertia::render('Projects/trash', compact('projects'));
    }

    /* RIPRISTONO ELEMENTO DAL CESTINO */
    public function restore($id)
    {
        /* RECUPERO UN PROGETTO SPECIFICO CHE E' STATO MESSO NEL CESTINO (NON ELIMINATO DEFINITIVAMENTE) */
        $project = Project::withTrashed()->findOrFail($id);

        /* RIPRISTINO */
        $project->restore();

        /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO  */
        return Redirect::route('projects.index')->with('message', 'Progetto ' . $project->name . ' ripreso dal cestino')->with('type', 'restore');
    }
}