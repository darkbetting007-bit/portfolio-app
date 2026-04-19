@php $about = App\Models\About::first(); @endphp
<header x-data="{ mobileMenuOpen: false }"
        class="sticky top-0 z-50 bg-black/80 backdrop-blur-md text-white shadow-sm">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight">
            {{ $about->name ?? 'Portfolio' }}
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden md:flex space-x-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-gray-300 transition">Home</a>
            <a href="#projects" class="hover:text-gray-300 transition">Projects</a>
            <a href="#skills" class="hover:text-gray-300 transition">Skills</a>
            <a href="#contact" class="hover:text-gray-300 transition">Contact</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition">Admin</a>
            @endauth
        </div>

        {{-- Mobile Menu Button --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 focus:outline-none">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </nav>

    {{-- Mobile Menu Dropdown --}}
    <div x-show="mobileMenuOpen"
         @click.away="mobileMenuOpen = false"
         x-transition
         class="md:hidden bg-black/90 backdrop-blur-md py-4">
        <div class="container mx-auto px-4 flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="py-2 hover:text-gray-300 transition">Home</a>
            <a href="#projects" class="py-2 hover:text-gray-300 transition">Projects</a>
            <a href="#skills" class="py-2 hover:text-gray-300 transition">Skills</a>
            <a href="#contact" class="py-2 hover:text-gray-300 transition">Contact</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="py-2 text-gray-400 hover:text-white">Admin</a>
            @endauth
        </div>
    </div>
</header>