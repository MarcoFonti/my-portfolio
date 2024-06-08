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
        $skills = SkillResource::collection(Skill::with('projects')->get());

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

        /* CONTROLLO FILE IMAGE E CREO CARTELLA SKILLS PER LE IMMAGINI */
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');

            /* CREO E SALVO LA CHIAMATA */
            $skill = Skill::create([
                'name' => $request->name,
                'image' => $image
            ]);

            /* ITERO SU OGNI ID PER TROVARE IL PROGETTO CORRISPONDENTE E LO ASSOCIO ALLA SKILL UTILIZZANDO IL METOTO ATTACH (SELECT MULTIPLA) */
            foreach ($request->project_ids as $projectId) {
                $project = Project::find($projectId);
                if ($project) {
                    $skill->projects()->attach($projectId);
                }
            }

            /* REINDIRIZZO ALLA ROTTA INDEX */
            return Redirect::route('skills.index');
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
    public function edit($id)
    {

        /* CERCO LA SKILL CON ID SPECIFICO E UTILIZZO IL METODO 'WITH' PER CARICARE I PROGETTI ASSOCCIATI */
        $skill = Skill::with('projects')->findOrFail($id);

        /* RECUEPRO TUTTI I PROGETTI */
        $projects = Project::all();

        /* ESTRAGGO GLI ID DEI PROGETTI ASSOCIATI ALLA SKILL E SALVO LI SALVO IN UN ARRAY */
        $skill->project_ids = $skill->projects->pluck('id')->toArray();

        /* VISTA PER IL MODOFICA */
        return Inertia::render('Skills/edit', compact('skill', 'projects',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        /* ASSEGNO L'IMMGINE ATTULALE A UNA VARIBILE */
        $image = $skill->image;

        /* VERIFICO SE NELLA REQUEST C'E' UN FILE 'IMAGE', SE CE UNA NUOVA IMMAGINE ELIMINO LA PRECENDETE, E LA SALVO */
        if ($request->hasFile('image')) {
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        /* AGGIORNO I VALORI DELLA SKILL */
        $skill->update([
            'name' => $request->name,
            'image' => $image,
        ]);

        /* RIMUOVO E AGGIUNGO LE ASSOCIAZIONI NECESSARIE IN MODO CHE GLI ID DEI PROGETTI ASSOCIATI ALLA SKILL CORRISPONDONDO AGLI ID DELLA RICHIESTA */
        $skill->projects()->sync($request->project_ids);

        /* PAGINA INDEX */
        return Redirect::route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}