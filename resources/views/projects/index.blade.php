@extends('layouts.app')

@section('title', 'My Projects - Your Name')
@section('description', 'Browse a collection of web development projects by Your Name, showcasing diverse technologies and solutions.')

@section('content')
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-900">My Projects</h1>
    <livewire:project-list /> {{-- This is where your Livewire component renders --}}
@endsection
