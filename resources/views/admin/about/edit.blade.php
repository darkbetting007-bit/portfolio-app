@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-bold mb-6">Edit About / Profile</h1>
    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium mb-1">Name *</label>
            <input type="text" name="name" value="{{ old('name', $about->name) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $about->title) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">Description *</label>
            <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ old('description', $about->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium mb-1">Avatar</label>
            @if($about->avatar)
                <img src="{{ Storage::url($about->avatar) }}" class="h-16 w-16 rounded-full object-cover mb-2">
            @endif
            <input type="file" name="avatar" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block font-medium mb-1">CV (PDF)</label>
            @if($about->cv_file)
                <a href="{{ Storage::url($about->cv_file) }}" target="_blank" class="text-blue-600 text-sm block mb-2">Current CV</a>
            @endif
            <input type="file" name="cv_file" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $about->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $about->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
        </div>
        <div>
            <label class="block font-medium mb-1">Address</label>
            <input type="text" name="address" value="{{ old('address', $about->address) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Update Profile</button>
        </div>
    </form>
</div>
@endsection