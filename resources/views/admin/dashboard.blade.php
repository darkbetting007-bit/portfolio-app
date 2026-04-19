@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-lg font-medium text-gray-500">Projects</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Project::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-lg font-medium text-gray-500">Skills</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Skill::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm">
        <h3 class="text-lg font-medium text-gray-500">Messages</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Contact::where('is_read', false)->count() }}</p>
    </div>
</div>
@endsection