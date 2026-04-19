<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::firstOrCreate(
            ['name' => 'Your Name'],
            [
                'title' => 'Web Developer',
                'description' => 'I build exceptional digital experiences.',
            ]
        );
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::firstOrFail();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
            'cv_file' => 'nullable|file|mimes:pdf|max:5120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        if ($request->hasFile('avatar')) {
            if ($about->avatar) {
                Storage::disk('public')->delete($about->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($about->cv_file) {
                Storage::disk('public')->delete($about->cv_file);
            }
            $validated['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $about->update($validated);
        return redirect()->route('admin.about.edit')->with('success', 'Profile updated.');
    }
}