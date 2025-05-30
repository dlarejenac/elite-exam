@extends('layouts.app')

@section('title')
    Artist Details
@endsection

@section('artists')
<div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Artist Details</h1>

    <div class="mb-5">
        <label class="block text-sm font-medium text-gray-500 mb-1">Code</label>
        <p class="text-gray-900 text-base font-medium">{{ $artist->code }}</p>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
        <p class="text-gray-900 text-base font-medium">{{ $artist->name }}</p>
    </div>

    <div class="mt-8 flex items-center justify-between">
        <a href="{{ route('artists.index') }}"
        class="text-gray-600 hover:underline text-sm">
            ← Back to List
        </a>
        <div class="flex space-x-4">
            <a href="{{ route('artists.edit', $artist) }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 shadow-md">
                Edit
            </a>

            <form action="{{ route('artists.destroy', $artist) }}" method="POST"
                onsubmit="return confirm('Delete this artist?');"
                class="inline-flex items-center">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 shadow-md">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
