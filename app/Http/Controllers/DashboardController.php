<?php

namespace App\Http\Controllers;

use App\Models\Contact; // Assuming Contact is your model for messages
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        $skills = Skill::all();
        
        $messages = Contact::orderBy('created_at', 'desc')->get();

        return Inertia::render('Dashboard', compact('messages', 'projects', 'skills'));
    }

}