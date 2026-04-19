@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="py-20 bg-black">
    <div class="container mx-auto px-4 max-w-5xl">
        <a href="{{ route('home') }}#all-projects"
           class="inline-flex items-center text-gray-400 hover:text-white mb-8" data-aos="fade-right">
            ← Back to projects
        </a>

        <div class="grid md:grid-cols-2 gap-12">
            <div data-aos="fade-right">
                @if($project->image)
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                         class="rounded-2xl shadow-lg w-full border border-gray-800">
                @else
                    <div class="aspect-video bg-gray-800 rounded-2xl flex items-center justify-center text-gray-500 border border-gray-700">
                        No Image
                    </div>
                @endif
            </div>

            <div data-aos="fade-left">
                <h1 class="text-4xl font-bold mb-4 text-white">{{ $project->title }}</h1>
                @if($project->tech_stack)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($project->tech_stack as $tech)
                        <span class="text-sm bg-gray-800 text-gray-300 px-3 py-1 rounded-full">{{ $tech }}</span>
                    @endforeach
                </div>
                @endif
                <div class="prose prose-invert prose-lg text-gray-300 mb-8">
                    {!! nl2br(e($project->description)) !!}
                </div>
                <div class="flex gap-4">
                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank"
                           class="px-6 py-3 bg-white text-black rounded-full hover:bg-gray-200 transition font-semibold">
                            Live Demo
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank"
                           class="px-6 py-3 border border-gray-600 text-white rounded-full hover:bg-gray-800 transition">
                            GitHub
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection