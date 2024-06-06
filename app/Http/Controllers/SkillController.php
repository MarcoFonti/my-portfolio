<?php

namespace App\Http\Controllers;

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
        return Inertia::render('Skills/index');
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
    public function store(Request $request)
    {
        /* VALIDAZIONE */
        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'project_ids' => ['exists:projects,id']
        ],[
            'image.required' => 'L\'immagine è obbligatoria.',
            'image.image' => 'Il file deve essere un\'immagine.',
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'project_ids.exists' => 'Uno o più dei progetti selezionati non sono validi.',
        ]);

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

            return Redirect::route('skills.index');
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