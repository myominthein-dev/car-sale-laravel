@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-600 mb-4">
                403
            </h1>
            <p class="text-xl text-gray-800 mb-4">
                Oops! You don’t have permission to view this page.
            </p>
            <p class="text-gray-600 mb-6">
                It seems like you're trying to access something that is forbidden. Maybe you need higher permissions or it's just not your time yet.
            </p>
            <a href="{{ route('/') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg text-lg transition">
                Go Back
            </a>
        </div>
    </div>
</div>
@endsection
