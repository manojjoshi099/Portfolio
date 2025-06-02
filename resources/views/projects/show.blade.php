@extends('layouts.app')

{{-- Dynamically set the page title based on the project title --}}
@section('title', $project->title . ' - Your Name\'s Portfolio')

{{-- Dynamically set the meta description from the project's short description --}}
@section('description', Str::limit($project->short_description, 160))

@section('content')
    <article class="bg-white p-8 rounded-lg shadow-lg max-w-5xl mx-auto">
        {{-- Back button --}}
        <div class="mb-6">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i> Back to Projects
            </a>
        </div>

        {{-- Project Title --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $project->title }}</h1>

        {{-- Technologies Used --}}
        @if($project->technologies)
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($project->technologies as $tech)
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full shadow-sm">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Featured Image --}}
        @if($project->featured_image)
            <figure class="mb-8">
                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}" class="w-full h-96 object-cover rounded-lg shadow-md border border-gray-200">
                <figcaption class="text-center text-gray-500 text-sm mt-2">Main project image</figcaption>
            </figure>
        @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-xl rounded-lg shadow-md mb-8">
                No featured image available
            </div>
        @endif

        {{-- Long Description --}}
        <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
            {{-- Use {!! !!} to render rich text (HTML) from the database --}}
            {!! $project->long_description !!}
        </div>

        {{-- Additional Screenshots --}}
        @if($project->screenshots && count($project->screenshots) > 0)
            <h3 class="text-3xl font-semibold text-gray-900 mb-6 border-b pb-2">Screenshots</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($project->screenshots as $screenshot)
                    <figure class="bg-gray-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        <img src="{{ asset('storage/' . $screenshot) }}" alt="{{ $project->title }} Screenshot" class="w-full h-56 object-cover transform hover:scale-105 transition duration-300">
                        <figcaption class="p-3 text-center text-gray-600 text-sm">{{ Str::afterLast($screenshot, '/') }}</figcaption>
                    </figure>
                @endforeach
            </div>
        @endif

        {{-- Project Links --}}
        <div class="flex flex-wrap justify-center gap-6 mt-8">
            @if($project->live_url)
                <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer" class="px-8 py-3 bg-green-600 text-white rounded-full text-lg font-semibold hover:bg-green-700 transition duration-300 shadow-lg flex items-center">
                    <i class="fas fa-external-link-alt mr-2"></i> Live Demo
                </a>
            @endif
            @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="px-8 py-3 bg-gray-800 text-white rounded-full text-lg font-semibold hover:bg-gray-900 transition duration-300 shadow-lg flex items-center">
                    <i class="fab fa-github mr-2"></i> GitHub Repo
                </a>
            @endif
        </div>
    </article>
@endsection
