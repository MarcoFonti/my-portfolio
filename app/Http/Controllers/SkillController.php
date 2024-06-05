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
        $projects = Project::all();
        return Inertia::render('Skills/create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'project_ids' => ['exists:projects,id']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');
            $skill = Skill::create([
                'name' => $request->name,
                'image' => $image
            ]);

            // Associare la skill a ciascun progetto selezionato
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