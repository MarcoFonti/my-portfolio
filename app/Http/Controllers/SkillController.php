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
        return Inertia::render('Skills/index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        /* RECUEPRO I PROGETTI */
        $projects = Project::all();
        return Inertia::render('Skills/create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {

        /* CONTROLLO FILE IMAGE CARTELLA SKILLS PER LE IMMAGINI */
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
        $skill = Skill::with('projects')->findOrFail($id);
        $projects = Project::all();
        
        
        $skill->project_ids = $skill->projects->pluck('id')->toArray();
        return Inertia::render('Skills/edit', compact('skill', 'projects',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        // Memorizza l'immagine corrente
    $image = $skill->image;

    if($request->hasFile('image')){
        Storage::delete($skill->image);
        $image = $request->file('image')->store('skills');
    }

    // Aggiorna il nome e l'immagine della skill
    $skill->update([
        'name' => $request->name,
        'image' => $image,
    ]);

    // Aggiorna i progetti associati
    $skill->projects()->sync($request->project_ids);

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