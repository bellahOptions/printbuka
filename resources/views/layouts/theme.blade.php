<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', "Premium Custom Printing & Corporate Gift Solutions in Nigeria")</title>    
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css','resources/js/app.js'])
        <style>
    [x-cloak] { display: none !important; }
</style>
    </head>
    <body>
        @include('layouts.navbar')
       @yield('content')
    </body>
</html>
