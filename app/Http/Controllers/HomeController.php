<?php

namespace App\Http\Controllers;

use App\Models\AboutMes;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $aboutMe = AboutMes::first(); // Fetch the single AboutMe record
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('order')
            ->limit(3) // Display up to 3 featured projects
            ->get();
        return view('home', compact('aboutMe', 'featuredProjects'));
    }
}
