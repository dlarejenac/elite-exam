@extends('layouts.app')

@section('title')
    Artists
@endsection

@section('artists')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Artists</h1>
        <a href="{{ route('artists.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 shadow-md transition">
            + Add Artist
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10A8 8 0 11..." clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Code</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artists as $artist)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $artist->code }}</td>
                        <td class="px-6 py-4">{{ $artist->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('artists.show', $artist) }}" class="font-medium text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center px-6 py-4 text-gray-500">No artists found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $artists->links('pagination::tailwind') }}
    </div>

    <a href="{{ route('admin.dashboard') }}"
            class="inline-block text-gray-600 hover:underline text-sm">
                ← Back to Dashboard
            </a>
</div>
@endsection