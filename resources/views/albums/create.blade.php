@extends('layouts.app')

@section('title')
    Create Album
@endsection

@section('albums')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Album</h1>

    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="artist_id" class="block mb-2 text-sm font-medium text-gray-900">Artist</label>
            <select name="artist_id" id="artist_id" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('artist_id') border-red-500 @enderror">
                <option value="">Select Artist</option>
                @foreach($artists as $artist)
                    <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                        {{ $artist->name }}
                    </option>
                @endforeach
            </select>
            @error('artist_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Album Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Year</label>
            <input type="number" name="year" id="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('year') border-red-500 @enderror">
            @error('year')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sales" class="block mb-2 text-sm font-medium text-gray-900">Sales</label>
            <input type="number" name="sales" id="sales" value="{{ old('sales') }}" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('sales') border-red-500 @enderror">
            @error('sales')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cover" class="block mb-2 text-sm font-medium text-gray-900">Album Cover (optional)</label>
            <input type="file" name="cover" id="cover"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('cover') border-red-500 @enderror">
            @error('cover')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('albums.index') }}" class="inline-block text-gray-600 hover:underline text-sm">
                ← Back to List
            </a>

            <button type="submit"
                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow">
                Save Album
            </button>
        </div>
    </form>
</div>
@endsection