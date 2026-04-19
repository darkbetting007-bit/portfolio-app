@extends('layouts.admin')

@section('title', $project->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h1 class="text-2xl font-bold">Project Details</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.projects.edit', $project) }}"
               class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Edit</a>
            <a href="{{ route('admin.projects.index') }}"
               class="inline-block border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition">Back to List</a>
        </div>
    </div>

    <div class="p-6">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Image --}}
            <div>
                @if($project->image)
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                         class="w-full h-auto rounded-lg shadow-sm object-cover">
                @else
                    <div class="w-full aspect-video bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center text-gray-500">
                        No Image Available
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="space-y-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $project->title }}</h2>
                    <p class="text-gray-500 text-sm mt-1">Slug: {{ $project->slug }}</p>
                </div>

                @if($project->short_description)
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Short Description</h3>
                    <p class="mt-1 text-gray-700">{{ $project->short_description }}</p>
                </div>
                @endif

                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Full Description</h3>
                    <div class="mt-2 prose prose-sm max-w-none text-gray-700">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                @if($project->tech_stack)
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tech Stack</h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($project->tech_stack as $tech)
                            <span class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Project URL</h3>
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $project->project_url }}
                            </a>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">GitHub</h3>
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $project->github_url }}
                            </a>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Completed</h3>
                        <p>{{ $project->completed_at ? $project->completed_at->format('F Y') : '—' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Featured</h3>
                        <span class="inline-block px-3 py-1 text-sm rounded-full {{ $project->featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $project->featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                </div>

                <div class="text-sm text-gray-500 pt-2">
                    <p>Created: {{ $project->created_at->format('d M Y H:i') }}</p>
                    <p>Last updated: {{ $project->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Delete Button (with caution) --}}
        <div class="mt-8 pt-6 border-t flex justify-end">
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Delete Project
                </button>
            </form>
        </div>
    </div>
</div>
@endsection