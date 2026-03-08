@extends('layouts.theme')

@section('content')

<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://unsplash.com/photos/a-machine-that-is-cutting-a-sheet-of-paper-g9_KP2fvFII')] bg-cover bg-center bg-no-repeat opacity-25"
         style="background-image: url('https://unsplash.com/photos/a-machine-that-is-cutting-a-sheet-of-paper-g9_KP2fvFII')">
    </div>
    <div class="absolute inset-0 bg-gray-900"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                         tracking-widest uppercase bg-cyan-600 text-white mb-5">
                ✦ Printbuka Blog
            </span>
            <h1 class="font-black text-white leading-[1.05] mb-5"
                style="font-size: clamp(2.2rem, 5vw, 4rem)">
                Welcome to<br>
                <span class="bg-pink-500 bg-clip-text text-transparent">
                    Printbuka Blog
                </span>
            </h1>
            <p class="text-white/60 text-base leading-relaxed max-w-lg">
                Discover, Learn get latest updates from our experts 
            </p>
        </div>
    </div>
    
</section>


<div class="max-w-6xl mx-auto py-12 px-12">



<div class="grid md:grid-cols-3 gap-8">

@foreach($blogs as $blog)

<a href="{{ route('blog.show',$blog->slug) }}" 
class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg">

@if($blog->featured_image)

<img src="{{ asset('storage/blog/'.$blog->featured_image) }}"
class="w-full h-48 object-cover">

@endif

<div class="p-6">

<h2 class="text-xl font-bold text-gray-900 mb-2">
{{ $blog->title }}
</h2>

<p class="text-gray-900 text-sm mb-4">
{{ $blog->excerpt }}
</p>

<span class="text-pink-600 font-semibold">
Read More →
</span>

</div>

</a>

@endforeach

</div>

</div>

@endsection