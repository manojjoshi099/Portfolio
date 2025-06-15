<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutMeController extends Controller
{
    /**
     * Show the form for editing the About Me singleton.
     */
    public function edit()
    {
        $aboutMe = AboutMes::first(); // There should only be one record
        if (!$aboutMe) {
            // Create a new empty record if none exists
            $aboutMe = AboutMes::create([
                'title' => 'Your Name - Web Developer',
                'content' => 'Write a short introduction about yourself here.',
            ]);
        }
        return view('admin.about-me.edit', compact('aboutMe'));
    }

    /**
     * Update the About Me singleton in storage.
     */
    public function update(Request $request)
    {
        $aboutMe = AboutMes::first();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cv_link' => 'nullable|file|mimes:pdf|max:5120', // Max 5MB PDF
        ]);

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            if ($aboutMe->profile_picture) {
                Storage::disk('public')->delete($aboutMe->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('images', 'public');
        } elseif ($request->boolean('remove_profile_picture')) {
            if ($aboutMe->profile_picture) {
                Storage::disk('public')->delete($aboutMe->profile_picture);
            }
            $validated['profile_picture'] = null;
        }

        // Handle CV link
        if ($request->hasFile('cv_link')) {
            if ($aboutMe->cv_link) {
                Storage::disk('public')->delete($aboutMe->cv_link);
            }
            $validated['cv_link'] = $request->file('cv_link')->store('documents', 'public');
        } elseif ($request->boolean('remove_cv_link')) {
            if ($aboutMe->cv_link) {
                Storage::disk('public')->delete($aboutMe->cv_link);
            }
            $validated['cv_link'] = null;
        }

        $aboutMe->update($validated);

        return redirect()->route('admin.about-me.edit')->with('status', 'About Me updated successfully!');
    }
}
