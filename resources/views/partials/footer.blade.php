@php $about = App\Models\About::first(); @endphp
<footer class="bg-black text-gray-400 py-8 border-t border-gray-800">
    <div class="container mx-auto px-4 text-center text-sm">
        <p>&copy; {{ date('Y') }} {{ $about->name ?? 'Your Name' }}. All rights reserved.</p>
    </div>
</footer>