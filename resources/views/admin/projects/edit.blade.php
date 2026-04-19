@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Project: {{ $project->title }}</h1>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block font-medium mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $project->title) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Short Description --}}
        <div>
            <label class="block font-medium mb-1">Short Description</label>
            <input type="text" name="short_description" value="{{ old('short_description', $project->short_description) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('short_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Full Description --}}
        <div>
            <label class="block font-medium mb-1">Description <span class="text-red-500">*</span></label>
            <textarea name="description" rows="6"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                      required>{{ old('description', $project->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Current Image & Upload --}}
        <div>
            <label class="block font-medium mb-1">Current Image</label>
            @if($project->image)
                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="h-24 w-auto object-cover rounded-lg mb-2 border">
            @else
                <p class="text-gray-500 text-sm">No image uploaded</p>
            @endif
            <label class="block font-medium mb-1 mt-3">Change Image (optional)</label>
            <input type="file" name="image"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- URLs --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Project URL</label>
                <input type="url" name="project_url" value="{{ old('project_url', $project->project_url) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('project_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('github_url')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Tech Stack --}}
        <div>
            <label class="block font-medium mb-1">Tech Stack</label>
            <input type="text" name="tech_stack"
                   value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack) }}"
                   placeholder="Laravel, Tailwind, Alpine.js"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">Separate with commas</p>
            @error('tech_stack')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Completed Date & Featured --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Completed Date</label>
                <input type="date" name="completed_at"
                       value="{{ old('completed_at', $project->completed_at ? $project->completed_at->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('completed_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="featured" value="1" id="featured"
                       {{ old('featured', $project->featured) ? 'checked' : '' }}
                       class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="featured" class="font-medium">Featured Project</label>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.projects.index') }}"
               class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Update Project</button>
        </div>
    </form>
</div>
@endsection