@extends('layouts.app')

@section('title')
    Create Artist
@endsection

@section('artists')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Artist</h1>

    <form action="{{ route('artists.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="code" class="block mb-2 text-sm font-medium text-gray-900">Code</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('code') border-red-500 @enderror" required>
            @error('code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('artists.index') }}"
            class="inline-block text-gray-600 hover:underline text-sm">
                ← Back to List
            </a>

            <button type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow">
                Save Artist
            </button>
        </div>
    </form>
</div>
@endsection