@extends('layouts.admin')

@section('title', 'Edit Skill')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Skill: {{ $skill->name }}</h1>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block font-medium mb-1">Skill Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div>
            <label class="block font-medium mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category', $skill->category) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Percentage --}}
        <div>
            <label class="block font-medium mb-1">Proficiency (%) <span class="text-red-500">*</span></label>
            <input type="number" name="percentage" value="{{ old('percentage', $skill->percentage) }}" min="0" max="100"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   required>
            @error('percentage')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Icon --}}
        <div>
            <label class="block font-medium mb-1">Icon Class (optional)</label>
            <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('icon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.skills.index') }}"
               class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Cancel</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Update Skill</button>
        </div>
    </form>
</div>
@endsection