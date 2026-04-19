<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-sm">
            <div class="p-6">
                <h2 class="text-xl font-bold">Portfolio Admin</h2>
            </div>
            <nav class="px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">Projects</a>
                <a href="{{ route('admin.skills.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">Skills</a>
                <a href="{{ route('admin.about.edit') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">About</a>
                <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-100">Messages</a>
                <hr class="my-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg">Logout</button>
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>