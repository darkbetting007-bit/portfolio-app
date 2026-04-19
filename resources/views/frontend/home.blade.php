@extends('layouts.app')

@section('title', $about->name ?? 'Portfolio')

@section('content')
{{-- Hero Section --}}
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-gray-800 text-white">
    <div class="container mx-auto px-4 py-20 text-center" data-aos="fade-up">
        @if($about && $about->avatar)
            <img src="{{ Storage::url($about->avatar) }}" alt="{{ $about->name }}"
                 class="w-32 h-32 rounded-full mx-auto mb-6 object-cover border-4 border-gray-700 shadow-2xl">
        @endif
        <h1 class="text-5xl md:text-7xl font-bold mb-4">{{ $about->name ?? 'Your Name' }}</h1>
        <p class="text-xl md:text-2xl text-gray-400 mb-8">{{ $about->title ?? 'Creative Developer' }}</p>
        <p class="max-w-2xl mx-auto text-gray-300 mb-10">{{ $about->description ?? '' }}</p>
        <div class="flex flex-wrap gap-4 justify-center">
            @if($about && $about->cv_file)
                <a href="{{ Storage::url($about->cv_file) }}"
                   class="px-8 py-3 bg-white text-black rounded-full hover:bg-gray-200 transition font-semibold shadow-lg" download>
                    Download CV
                </a>
            @endif
            <a href="#contact"
               class="px-8 py-3 border border-gray-600 text-white rounded-full hover:bg-gray-800 hover:border-gray-800 transition font-semibold">
                Contact Me
            </a>
        </div>
    </div>
</section>

{{-- Featured Projects --}}
@if($featuredProjects->count())
<section id="projects" class="py-20 bg-black">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-white" data-aos="fade-up">Featured Projects</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($featuredProjects as $project)
            <div class="group bg-gray-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-800"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="aspect-video bg-gray-800 relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-white text-xl font-bold">
                            {{ $project->title }}
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-white">{{ $project->title }}</h3>
                    <p class="text-gray-400 mb-4">{{ $project->short_description ?? Str::limit($project->description, 100) }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project->tech_stack ?? [] as $tech)
                            <span class="text-xs bg-gray-800 text-gray-300 px-2 py-1 rounded-full">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <a href="{{ route('project.show', $project->slug) }}"
                       class="inline-flex items-center text-blue-400 font-medium hover:text-blue-300">
                        View Project <span class="ml-1">→</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section id="projects" class="py-20 bg-black">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-8">Featured Projects</h2>
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-12 max-w-2xl mx-auto">
            <p class="text-gray-400">No featured projects yet.</p>
            @auth
                <a href="{{ route('admin.projects.create') }}" class="mt-4 inline-block text-blue-400 hover:underline">
                    + Add Project
                </a>
            @endauth
        </div>
    </div>
</section>
@endif

{{-- Skills Section --}}
@if($skills && $skills->count())
<section id="skills" class="py-20 bg-gray-900">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-white" data-aos="fade-up">Skills & Expertise</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($skills as $skill)
            <div class="bg-gray-800 p-6 rounded-2xl shadow-lg border border-gray-700"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-semibold text-lg text-white">{{ $skill->name }}</h3>
                    <span class="text-blue-400 font-bold">{{ $skill->percentage }}%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2.5">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-400 h-2.5 rounded-full"
                         style="width: {{ $skill->percentage }}%"></div>
                </div>
                @if($skill->category)
                <p class="text-xs text-gray-500 mt-3 uppercase tracking-wider">{{ $skill->category }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- All Projects Grid --}}
@if($projects->count())
<section id="all-projects" class="py-20 bg-black">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-white" data-aos="fade-up">All Projects</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="bg-gray-900 rounded-xl overflow-hidden hover:shadow-md transition border border-gray-800"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <a href="{{ route('project.show', $project->slug) }}">
                    <div class="aspect-video bg-gray-800">
                        @if($project->image)
                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-lg text-white">{{ $project->title }}</h3>
                        <p class="text-gray-400 text-sm mt-1">
                            {{ Str::limit($project->short_description ?? $project->description, 80) }}
                        </p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-10">
            {{ $projects->links() }}
        </div>
    </div>
</section>
@endif

{{-- Contact Section --}}
<section id="contact" class="py-20 bg-gray-900">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-4xl font-bold text-center mb-8 text-white" data-aos="fade-up">Get In Touch</h2>
        <p class="text-center text-gray-400 mb-12" data-aos="fade-up" data-aos-delay="100">
            I'm currently available for freelance work or full-time positions.
        </p>

        <div x-data="contactForm()" class="bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-700"
             data-aos="fade-up" data-aos-delay="200">
            <form @submit.prevent="submitForm" action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Name</label>
                        <input type="text" name="name" x-model="form.name"
                               class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Email</label>
                        <input type="email" name="email" x-model="form.email"
                               class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2 text-gray-300">Subject</label>
                    <input type="text" name="subject" x-model="form.subject"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2 text-gray-300">Message</label>
                    <textarea name="message" rows="5" x-model="form.message"
                              class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              required></textarea>
                </div>
                <div>
                    <button type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-white text-black rounded-full hover:bg-gray-200 transition font-semibold shadow-md"
                            :disabled="loading">
                        <span x-show="!loading">Send Message</span>
                        <span x-show="loading">Sending...</span>
                    </button>
                </div>
                <div x-show="success" class="mt-4 p-4 bg-green-900 text-green-200 rounded-lg" x-text="successMessage"></div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function contactForm() {
        return {
            form: { name: '', email: '', subject: '', message: '' },
            loading: false,
            success: false,
            successMessage: '',
            async submitForm() {
                this.loading = true;
                try {
                    const response = await fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.form)
                    });
                    const data = await response.json();
                    if (response.ok) {
                        this.success = true;
                        this.successMessage = data.message;
                        this.form = { name: '', email: '', subject: '', message: '' };
                    }
                } catch (error) {
                    console.error(error);
                }
                this.loading = false;
            }
        }
    }
</script>
@endpush