<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
            $image = $request->file('image')->store('skills', 'public');

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