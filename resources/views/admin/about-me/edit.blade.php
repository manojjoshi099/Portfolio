@extends('admin.layouts.app')

@section('title', 'Manage About Me')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage About Me</h1>

        <form action="{{ route('admin.about-me.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700">Title / Headline</label>
                    <input type="text" name="title" id="title" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('title', $aboutMe->title) }}" required>
                    @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="content" class="block font-medium text-sm text-gray-700">Content (Your Bio)</label>
                    <textarea name="content" id="content" rows="10" class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('content', $aboutMe->content) }}</textarea>
                    @error('content')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="profile_picture" class="block font-medium text-sm text-gray-700">Profile Picture</label>
                    @if($aboutMe->profile_picture)
                        <div class="mt-2 mb-2">
                            <img src="{{ asset('storage/' . $aboutMe->profile_picture) }}" alt="Current Profile Picture" class="h-20 w-20 rounded-full object-cover">
                            <label class="inline-flex items-center mt-1">
                                <input type="checkbox" name="remove_profile_picture" value="1" class="form-checkbox h-4 w-4 text-red-600">
                                <span class="ml-2 text-sm text-gray-600">Remove current picture</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" name="profile_picture" id="profile_picture" class="form-input mt-1 block w-full" accept="image/*">
                    @error('profile_picture')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="cv_link" class="block font-medium text-sm text-gray-700">CV / Resume (PDF)</label>
                    @if($aboutMe->cv_link)
                        <div class="mt-2 mb-2">
                            <a href="{{ asset('storage/' . $aboutMe->cv_link) }}" target="_blank" class="text-blue-600 hover:underline">Current CV (Click to View)</a>
                            <label class="inline-flex items-center mt-1">
                                <input type="checkbox" name="remove_cv_link" value="1" class="form-checkbox h-4 w-4 text-red-600">
                                <span class="ml-2 text-sm text-gray-600">Remove current CV</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" name="cv_link" id="cv_link" class="form-input mt-1 block w-full" accept="application/pdf">
                    @error('cv_link')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-8">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Update About Me
                </button>
            </div>
        </form>
    </div>
@endsection
