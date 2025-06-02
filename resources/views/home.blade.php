@extends('layouts.app')

@section('title', 'Your Name - Web Developer Portfolio')
@section('description', 'Showcasing web development projects and skills in Laravel, Vue.js, and more.')

@section('content')
    <section id="hero" class="text-center py-16 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg shadow-xl mb-12">
        <h1 class="text-5xl font-extrabold mb-4 animate-fade-in-down">Hi, I'm Your Name</h1>
        <p class="text-xl mb-6 animate-fade-in-up">A passionate Web Developer focused on building amazing digital experiences with Laravel.</p>
        <a href="{{ route('contact.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-100 transition duration-300 shadow-lg">Get in Touch</a>
    </section>

    @if($aboutMe)
        <section id="about-me" class="mb-12 bg-white p-8 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row items-center md:space-x-8">
                @if($aboutMe->profile_picture)
                    <div class="flex-shrink-0 mb-6 md:mb-0">
                        <img src="{{ asset('storage/' . $aboutMe->profile_picture) }}" alt="Profile Picture of Your Name" class="w-48 h-48 rounded-full object-cover shadow-md border-4 border-blue-200">
                    </div>
                @endif
                <div>
                    <h2 class="text-4xl font-bold mb-4 text-gray-900">{{ $aboutMe->title }}</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! $aboutMe->content !!}
                    </div>
                    @if($aboutMe->cv_link)
                        <a href="{{ asset('storage/' . $aboutMe->cv_link) }}" target="_blank" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">
                            <i class="fas fa-download mr-2"></i> Download CV
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <section id="featured-projects" class="mb-12">
        <h2 class="text-4xl font-bold text-center mb-8 text-gray-900">Featured Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredProjects as $project)
                @include('components.project-card', ['project' => $project])
            @empty
                <p class="col-span-full text-center text-gray-500">No featured projects available yet. Please add some from the admin panel!</p>
            @endforelse
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('projects.index') }}" class="px-8 py-3 bg-purple-600 text-white rounded-full text-lg font-semibold hover:bg-purple-700 transition duration-300 shadow-lg">View All Projects</a>
        </div>
    </section>
@endsection
