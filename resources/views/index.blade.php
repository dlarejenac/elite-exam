@extends('layouts.app')

@section('title')
    Elite Exam
@endsection

@section('exam-selection')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-xl bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Elite Software and Data Security
        </h2>
        <div class="flex justify-center space-x-6">
            <a href="{{ url('/php') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                PHP Exam
            </a>
            <a href="" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                MySQL Exam
            </a>
            <a href="" class="px-6 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition">
                Laravel Exam
            </a>
        </div>
    </div>
</div>
@endsection