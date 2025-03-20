<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-id" content="{{ Auth::id() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans min-h-screen relative !overflow-x-hidden flex flex-col ">
    @include('partials.header')

    <main class="relative">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('modals')

    @stack('scripts')

    
</body>

</html>
