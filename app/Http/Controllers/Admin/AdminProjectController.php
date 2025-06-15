<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // For slug generation

class AdminProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        $projects = Project::orderBy('order')->paginate(10); // Paginate for large lists
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug', // Will be auto-generated if null
            'short_description' => 'required|string|max:500',
            'long_description' => 'nullable|string',
            'technologies' => 'nullable|string', // Comma-separated string from frontend
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Array of images
            'is_featured' => 'boolean',
            'order' => 'required|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
        // Ensure slug is unique if auto-generated or explicitly set
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Project::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        // Handle file uploads
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('images/projects', 'public');
        }

        $screenshots = [];
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshotFile) {
                $screenshots[] = $screenshotFile->store('images/projects/screenshots', 'public');
            }
        }
        $validated['screenshots'] = $screenshots;

        // Convert technologies string to JSON array
        if (isset($validated['technologies'])) {
            $validated['technologies'] = json_encode(array_map('trim', explode(',', $validated['technologies'])));
        } else {
            $validated['technologies'] = json_encode([]);
        }

        // Set is_featured to false if checkbox not checked (HTML forms don't send unchecked checkboxes)
        $validated['is_featured'] = $request->has('is_featured');

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Project created successfully!');
    }

    /**
     * Display the specified project (optional for admin, often done via edit form).
     */
    public function show(Project $project)
    {
        // For admin panel, we often just redirect to the edit page or use a modal
        return redirect()->route('admin.projects.edit', $project);
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id, // Unique, ignore current project
            'short_description' => 'required|string|max:500',
            'long_description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_featured' => 'boolean',
            'order' => 'required|integer',
        ]);

        // Handle featured image update/deletion
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('images/projects', 'public');
        } elseif ($request->boolean('remove_featured_image')) { // Handle explicit removal checkbox
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $validated['featured_image'] = null;
        }

        // Handle screenshots update/deletion
        $currentScreenshots = $project->screenshots ?? [];
        $newScreenshots = [];

        // Add new screenshots
        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshotFile) {
                $newScreenshots[] = $screenshotFile->store('images/projects/screenshots', 'public');
            }
        }

        // Handle removal of specific screenshots (e.g., via checkboxes, usually by passing original paths to remove)
        // For simplicity, this example will just add new ones.
        // A more complex solution would involve hidden inputs with current paths and checkboxes to remove them.
        // For now, if you re-upload, it will add to the list. If you want to remove, you might have to clear and re-upload.
        // For production, consider using a JavaScript solution for fine-grained control.
        $validated['screenshots'] = array_merge($currentScreenshots, $newScreenshots);


        // Convert technologies string to JSON array
        if (isset($validated['technologies'])) {
            $validated['technologies'] = json_encode(array_map('trim', explode(',', $validated['technologies'])));
        } else {
            $validated['technologies'] = json_encode([]);
        }

        $validated['is_featured'] = $request->has('is_featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        // Delete associated files
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }
        if ($project->screenshots) {
            foreach ($project->screenshots as $screenshot) {
                Storage::disk('public')->delete($screenshot);
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted successfully!');
    }
}
