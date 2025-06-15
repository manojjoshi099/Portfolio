<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // This controller method serves the page that will host the Livewire component.
        // The Livewire component will handle fetching and filtering projects.
        return view('projects.index');
    }
    public function show(Project $project) // Laravel's Route Model Binding
    {
        // The controller fetches the specific project based on the slug.
        return view('projects.show', compact('project'));
    }
}
