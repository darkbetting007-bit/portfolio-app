@extends('layouts.admin')

@section('title', 'Add Project')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-bold mb-6">New Project</h1>
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium mb-1">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Short Description</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Description *</label>
            <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1">Image</label>
            <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Project URL</label>
                <input type="url" name="project_url" value="{{ old('project_url') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
        </div>
        <div>
            <label class="block font-medium mb-1">Tech Stack (comma separated)</label>
            <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" placeholder="Laravel, Tailwind, Alpine.js" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Completed Date</label>
                <input type="date" name="completed_at" value="{{ old('completed_at') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="mr-2">
                <label class="font-medium">Featured Project</label>
            </div>
        </div>
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Save</button>
        </div>
    </form>
</div>
@endsection