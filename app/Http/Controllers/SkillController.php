<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use function PHPUnit\Framework\returnSelf;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* RECUPERO VALORI MANIPOLATI DALLE RISORSE, E UTILIZZO IL METODO 'WITH' PER RECUPERARE I VALORI DELLA RELAZIONE CON I PROJECTS */
        $skills = SkillResource::collection(Skill::with('projects')->orderBy('created_at', 'desc')->get());

        /* VISTA DELLE SKILLS */
        return Inertia::render('Skills/index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        /* RECUEPRO I PROGETTI */
        $projects = Project::all();

        /* VISTA PER LA CREAZIONE */
        return Inertia::render('Skills/create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
            /* CREO E SALVO LA CHIAMATA */
            $skill = Skill::create([
                'name' => $request->name,
            ]);

            /* ITERO SU OGNI ID PER TROVARE IL PROGETTO CORRISPONDENTE E LO ASSOCIO ALLA SKILL UTILIZZANDO IL METOTO ATTACH (SELECT MULTIPLA) */
            if (!empty($request->project_ids)) {
                foreach ($request->project_ids as $projectId) {
                    $project = Project::find($projectId);

                    if ($project) {
                        $skill->projects()->attach($projectId);
                    }
                }
            }

            /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO */
            return Redirect::route('skills.index')->with('message', 'Skill ' . $skill->name . ' creata')->with('type', 'store');
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
    public function edit($id)
    {

        /* CERCO LA SKILL CON ID SPECIFICO E UTILIZZO IL METODO 'WITH' PER CARICARE I PROGETTI ASSOCCIATI */
        $skill = Skill::with('projects')->findOrFail($id);

        /* RECUEPRO TUTTI I PROGETTI */
        $projects = Project::all();

        /* ESTRAGGO GLI ID DEI PROGETTI ASSOCIATI ALLA SKILL E SALVO LI SALVO IN UN ARRAY */
        $skill->project_ids = $skill->projects->pluck('id')->toArray();

        /* VISTA PER IL MODIFICA */
        return Inertia::render('Skills/edit', compact('skill', 'projects',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        
        /* AGGIORNO I VALORI DELLA SKILL */
        $skill->update([
            'name' => $request->name,
        ]);

        /* RIMUOVO E AGGIUNGO I PROGETTI IN BASE ALLA RICHIESTA INVITA */
        $skill->projects()->sync($request->project_ids);

        /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO */
        return Redirect::route('skills.index')->with('message', 'Skill ' . $skill->name . ' modificata')->with('type', 'update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        /* ELIMINO SKILL */
        $skill->delete();

        /* REINDIRIZZO ALLA ROTTA PRECEDENTE, CON UN MESSSAGGIO */
        return Redirect::back()->with('message', 'Skill ' . $skill->name . ' messa nel cestino')->with('type', 'destroy');
    }

    /* CESTINO */
    public function trash()
    {
        /* RECUPERO TUTTI LE SKILLS ELIMINATE */
        $skills = Skill::onlyTrashed()->with('projects')->orderBy('created_at', 'desc')->get();

        /* VISTA SKILLS CESTINATE */
        return Inertia::render('Skills/trash', compact('skills'));
    }

    /* RIPRISTONO ELEMENTO DAL CESTINO */
    public function restore($id)
    {
        /* RECUPERO UNA SKILL SPECIFICA CHE E' STATA MESSA NEL CESTINO (NON ELIMINATA DEFINITIVAMENTE) */
        $skill = Skill::withTrashed()->findOrFail($id);

        /* RIPRISTINO */
        $skill->restore();

        /* REINDIRIZZO ALLA ROTTA INDEX, CON UN MESSAGGIO  */
        return Redirect::route('skills.index')->with('message', 'Skill ' . $skill->name . ' ripreso dal cestino')->with('type', 'restore');
    }
}