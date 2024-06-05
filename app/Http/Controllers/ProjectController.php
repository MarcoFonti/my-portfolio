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

        $skills = Skill::all();
        return Inertia::render('Projects/create', compact('skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'skill_ids' => ['exists:skills,id'],

        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('projects');
            $project = Project::create([
                'name' => $request->name,
                'image' => $image,
                'project_url' => $request->project_url
            ]);

            // Associare le skills al progetto solo se il progetto è stato creato
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