<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Printbuka') }}</title>    
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <main role="main" class="bg-gray-950 text-center text-gray-100">
            <div class="flex justify-center items-center p-4 flex-col min-h-screen">
                <img src="{{ asset('logo-dark.svg') }}" class="w-full md:w-100 my-5" alt="printbuka logo"/>
                <h1 class="text-5xl mb-5">PrintBuka is coming Soon!</h1>
                <p class="text-xl">We are building a new experience like never before</p>
                <a href="https://wa.link/nifgph" class="bg-[hsl(49,99%,57%)] text-gray-800 p-3 text-xl w-auto md:w-100 rounded-lg my-4 flex justify-center items-center space-x-5">Talk to Us 
                </a>
            </div>
        </main>
    </body>
</html>
