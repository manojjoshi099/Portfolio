<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Your Portfolio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- Your Public Header/Navigation (e.g., about, skills, projects, contact) --}}
    <header>
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center"> {{-- Centered, padded, flex container --}}
            {{-- Logo/Home Link (optional, replace with your actual logo if you have one) --}}
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 hover:text-indigo-600"></a>

            <div class="flex space-x-6"> {{-- Container for navigation links, with space between them --}}
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600 transition duration-300">Home</a>
                <a href="{{ route('about') }}"
                    class="text-gray-600 hover:text-indigo-600 transition duration-300">About</a>
                <a href="{{ route('skills.index') }}"
                    class="text-gray-600 hover:text-indigo-600 transition duration-300">Skills</a>
                <a href="{{ route('projects.index') }}"
                    class="text-gray-600 hover:text-indigo-600 transition duration-300">Projects</a>
                <a href="{{ route('contact.index') }}"
                    class="text-gray-600 hover:text-indigo-600 transition duration-300">Contact</a>

                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-600 hover:text-indigo-600 transition duration-300">Login</a>
                    <a href="{{ route('register') }}"
                        class="text-gray-600 hover:text-indigo-600 transition duration-300">Register</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-600 hover:text-indigo-600 transition duration-300">Dashboard</a>
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-gray-600 hover:text-indigo-600 transition duration-300">Admin Panel</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit"
                            class="text-red-600 hover:text-red-800 transition duration-300 bg-transparent border-none cursor-pointer p-0">Logout</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    {{-- Main content area --}}
    <main>
        @yield('content')
    </main>

    {{-- Your Custom Footer --}}
    <footer class="bg-gray-800 text-white py-4 text-center mt-12"> {{-- Footer with dark background, white text, padding, and margin-top --}}
        <p>&copy; {{ date('Y') }} Manoj Kumar Joshi. All rights reserved.</p>
        {{-- Add social links, etc. --}}
    </footer>
</body>

</html>
