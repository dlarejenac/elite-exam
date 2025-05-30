@extends('layouts.app')

@section('title')
    Admin Login
@endsection

@section('login')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-700">Admin Login</h2>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="text" name="username" id="username" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                              focus:border-blue-500 block w-full p-2.5">
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                              focus:border-blue-500 block w-full p-2.5">
            </div>

            <div>
                <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                               focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Login
                </button>
            </div>
        </form>

        @if($errors->any())
            <div class="mt-4 text-sm text-red-600">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</div>
@endsection