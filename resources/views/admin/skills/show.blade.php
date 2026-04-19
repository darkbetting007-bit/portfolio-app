@extends('layouts.admin')

@section('title', $skill->name)

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b flex justify-between items-center">
        <h1 class="text-2xl font-bold">Skill Details</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.skills.edit', $skill) }}"
               class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Edit</a>
            <a href="{{ route('admin.skills.index') }}"
               class="inline-block border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition">Back to List</a>
        </div>
    </div>

    <div class="p-6 space-y-6">
        {{-- Name --}}
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Skill Name</h3>
            <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $skill->name }}</p>
        </div>

        {{-- Category --}}
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Category</h3>
            <p class="mt-1 text-gray-700">{{ $skill->category ?? 'Uncategorized' }}</p>
        </div>

        {{-- Percentage --}}
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Proficiency Level</h3>
            <div class="mt-2 flex items-center">
                <span class="text-3xl font-bold text-gray-900 mr-4">{{ $skill->percentage }}%</span>
                <div class="flex-1 max-w-md">
                    <div class="w-full bg-gray-200 rounded-full h-4">
                        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Icon --}}
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Icon</h3>
            <p class="mt-1">
                @if($skill->icon)
                    <code class="bg-gray-100 px-3 py-1 rounded text-sm">{{ $skill->icon }}</code>
                @else
                    <span class="text-gray-400">No icon set</span>
                @endif
            </p>
        </div>

        {{-- Timestamps --}}
        <div class="border-t pt-4 text-sm text-gray-500">
            <p>Created: {{ $skill->created_at->format('d M Y H:i') }}</p>
            <p>Last updated: {{ $skill->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    {{-- Delete Button --}}
    <div class="p-6 bg-gray-50 border-t flex justify-end">
        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this skill?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                Delete Skill
            </button>
        </form>
    </div>
</div>
@endsection