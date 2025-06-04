<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Awesome Portfolio - @yield('title', 'Welcome')</title> {{-- Dynamic title --}}
    <meta name="description" content="@yield('description', 'Showcasing my web development projects and skills.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- This CDN link is for convenience. For production, consider self-hosting or using a build tool. --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevgBfLLlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles (place after your app.css) --}}
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 antialiased leading-normal tracking-wide">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-md py-4">
            <nav class="container mx-auto px-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900 hover:text-blue-600 transition duration-300">
                    Your Name's Portfolio
                </a>
                <div class="space-x-6 text-lg">
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">About</a>
                    <a href="{{ route('skills.index') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">Skills</a>
                    <a href="{{ route('projects.index') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">Projects</a>
                    <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">Contact</a>
                    {{-- You can add login/admin links here if needed --}}
                    {{-- @auth
                        <a href="{{ url('/admin') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">Admin</a>
                    @endauth --}}
                </div>
            </nav>
        </header>

        <main class="flex-grow container mx-auto px-4 py-10">
            @yield('content')
        </main>

        <footer class="bg-gray-800 text-white py-6 mt-10">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Your Name. All rights reserved.</p>
                <div class="mt-2 space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-linkedin"></i></a>
                    {{-- Add other social media links --}}
                </div>
            </div>
        </footer>
    </div>

    {{-- Livewire Scripts (place before closing </body> tag) --}}
    @livewireScripts
</body>
</html>
