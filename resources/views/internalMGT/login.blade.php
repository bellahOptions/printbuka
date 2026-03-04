<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Printbuka') }}</title>    
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        <main role="main" class="bg-gray-950 text-center flex items-center  justify-center rounded-2xl text-gray-100 min-h-screen">
            <div class="bg-gray-900 flex justify-center items-center p-3 md:p-10  flex-col w-auto h-auto rounded-2xl border-2 border-gray-700">
                <img src="{{ asset('logo-dark.svg') }}" class="w-20 md:w-50 my-5 mb-10" alt="printbuka logo"/>
                <h1 class="text-5xl mb-5">Admin Login</h1>
                <form action="{{ route('admin.login') }}" method="POST" class="w-full max-w-sm">
                    @csrf
                    <div class="mb-4">
                        <input type="email" name="email" placeholder="Email" required class="w-full p-3 rounded-lg bg-gray-800 text-gray-100 focus:outline-none focus:bg-gray-800 active:bg-gray-800 focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Password" required class="w-full p-3 rounded-lg bg-gray-800 text-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ old('password') }}">
                    </div>
                    <div class="mb-4 text-left">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" class="form-checkbox text-yellow-500">
                            <span class="ml-2">Remember Me</span>
                        </label>
                    <button type="submit" class="bg-[hsl(49,99%,57%)] text-gray-800 p-3 my-3 text-xl w-full rounded-lg">Login</button>   
                </form>
            </div>
        </main>
    </body>
</html>