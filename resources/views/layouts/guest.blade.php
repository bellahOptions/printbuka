<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 bg-pink-50">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0 min-h-screen">
            <div class="guest hidden bg-pink-500 min-h-screen md:flex md:items-center p-10 text">
            @if (request()->routeIs('login'))                
            <h1 class="text-4xl text-white text-center mb-3">Welcome Back!</h1>
            @elseif (request()->routeIs('register'))
            <h1 class="text-4xl text-white text-center mb-3">Create a PrintBuka Account!</h1>
            @elseif (request()->routeIs('password.request'))
            <h1 class="text-4xl text-white text-center mb-3">Reset Your Password</h1>
            @endif
            </div>
            <div class="bg-white min-h-screen flex justify-center items-center">
                <div class="form p-5 md:p-20 md:w-full">
                <div class="flex justify-center my-4">
                <a href="/">
                    <img src="{{ asset('logo.svg') }}" class="h-10 mb-4" alt="Printbuka Logo"/>
                </a>
            </div>
                {{ $slot }}
            </div>
            </div>
            </div>
        </div>
    </body>
</html>
