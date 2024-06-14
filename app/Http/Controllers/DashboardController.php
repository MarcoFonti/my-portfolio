<?php

namespace App\Http\Controllers;

use App\Models\Contact; // Assuming Contact is your model for messages
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $messages = Contact::all();
        return Inertia::render('Dashboard', compact('messages'));
    }

}