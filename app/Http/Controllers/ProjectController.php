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


        /* CREO E SALVO LA CHIAMATA */
        $project = Project::create([
            'name' => $request->name,
            'project_url' => $request->project_url
        ]);

        /* CONTROLLO SE NELLA REQUEST ABBIAMO L'ARRAY DELLE SKILL E UTILIZZO IL METODO ATTACH PER ASSOCIARLI AL PROGETTO (CHECKBOX) */
        if (Arr::exists($request, 'skill_ids')) {
            $project->skills()->attach($request->skill_ids);
        }



        /* REINDIRIZZO ALLA ROTTA INDEX */
        return Redirect::route('projects.index');
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
        /* CERCO LA SKILL CON ID SPECIFICO E UTILIZZO IL METODO 'WITH' PER CARICARE I PROGETTI ASSOCCIATI */
        $project = Project::with('skills')->findOrFail($id);

        /* RECUEPRO TUTTI I PROGETTI */
        $skills = Skill::all();

        /* ESTRAGGO GLI ID DEI PROGETTI ASSOCIATI ALLA SKILL E SALVO LI SALVO IN UN ARRAY */
        $project->skill_ids = $project->skills->pluck('id')->toArray();

        /* VISTA PER IL MODOFICA */
        return Inertia::render('Projects/edit', compact('skills', 'project',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        /* AGGIORNO I VALORI DELLA SKILL */
        $project->update([
            'name' => $request->name,
            'project_url' => $request->project_url,
        ]);

        $project->skills()->sync($request->skill_ids);

        /* PAGINA INDEX */
        return Redirect::route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        /* ELIMINO PROGETTO */
        $project->delete();

        /* REINDIRIZZO ALLA ROTTA PRECEDENTE */
        return Redirect::back();
    }

    /* ROTTE CESTINO */
    public function trash()
    {
        /* RECUPERO TUTTI LE SKILLS ELIMINATE */
        $projects = Project::onlyTrashed()->with('skills')->get();

        /* VISTA SKILLS CESTINATE */
        return Inertia::render('Projects/trash', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        /* PAGINA INDEX */
        return Redirect::route('projects.index');
    }
}