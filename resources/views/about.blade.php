{{--
    resources/views/pages/about.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'About PrintBuka — Our Story, Mission & Team')
@section('content')

{{-- ════════════════════════════════════════════════
     PAGE HERO
════════════════════════════════════════════════ --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://unsplash.com/photos/a-machine-that-is-cutting-a-sheet-of-paper-g9_KP2fvFII')] bg-cover bg-center bg-no-repeat opacity-25"
         style="background-image: url('https://unsplash.com/photos/a-machine-that-is-cutting-a-sheet-of-paper-g9_KP2fvFII')">
    </div>
    <div class="absolute inset-0 bg-gray-900"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                         tracking-widest uppercase bg-pink-600 text-white mb-5">
                ✦ Our Story
            </span>
            <h1 class="font-black text-white leading-[1.05] mb-5"
                style="font-size: clamp(2.2rem, 5vw, 4rem)">
                We Print.<br>
                <span class="bg-pink-500 bg-clip-text text-transparent">
                    We Personalise.
                </span><br>
                We Deliver Joy.
            </h1>
            <p class="text-white/60 text-base leading-relaxed max-w-lg">
                PrintBuka was born from one belief — that every brand, team, and individual deserves
                print products that truly reflect who they are. Not generic. Not rushed. Crafted with care.
            </p>
        </div>
    </div>
    
</section>


{{-- ════════════════════════════════════════════════
     MISSION / VISION / VALUES
════════════════════════════════════════════════ --}}
<section class="bg-white py-20 sm:py-24 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-gradient-to-br from-pink-50 to-pink-100/60 border border-pink-100 rounded-2xl p-8">
                <div class="w-11 h-11 rounded-xl bg-pink-600 flex items-center justify-center mb-5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-3">Our Mission</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    To make premium custom printing accessible to everyone in Nigeria — from the solo entrepreneur
                    ordering a single mug to the corporation needing thousands of branded uniforms. Quality without
                    compromise, starting at piece one.
                </p>
            </div>

            <div class="bg-gradient-to-br from-pink-50 to-pink-100/60 border border-pink-100 rounded-2xl p-8">
                <div class="w-11 h-11 rounded-xl bg-pink-600 flex items-center justify-center mb-5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-3">Our Vision</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    To be West Africa's most trusted custom print and gifting platform — where individuals,
                    brands, and businesses come to celebrate milestones, build identity, and create lasting
                    impressions through beautifully crafted products.
                </p>
            </div>

            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100/60 border border-yellow-100 rounded-2xl p-8">
                <div class="w-11 h-11 rounded-xl bg-yellow-500 flex items-center justify-center mb-5">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-800 text-xl mb-3">Our Values</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Quality first. Client obsession. Radical transparency — we send proofs before we print.
                    Speed without shortcuts. Pride in every piece that leaves our shop.
                    These aren't slogans. They're how we operate daily.
                </p>
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     OUR STORY
════════════════════════════════════════════════ --}}
<section id="story" class="bg-gray-50 py-20 sm:py-28 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col lg:flex-row items-center gap-14 xl:gap-20">

            {{-- Image side --}}
            <div class="lg:w-[45%] relative">
                <div class="rounded-2xl overflow-hidden aspect-video lg:aspect-square shadow-xl shadow-gray-300/40">
                    <img src="https://unsplash.com/photos/white-green-and-black-checked-textile-gjPSrg4xSNM"
                         alt="PrintBuka production team"
                         class="w-full h-full object-cover">
                </div>
                {{-- Floating stat cards --}}
                <div class="absolute -bottom-5 -left-4 bg-white rounded-2xl shadow-xl shadow-gray-200/60 p-4 border border-gray-100">
                    <p class="font-black text-3xl text-pink-600">200+</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Products Available</p>
                </div>
                <div class="absolute -top-5 -right-4 bg-white rounded-2xl shadow-xl shadow-gray-200/60 p-4 border border-gray-100">
                    <p class="font-black text-3xl text-pink-600">24h</p>
                    <p class="text-xs text-gray-500 font-medium mt-0.5">Min. Turnaround</p>
                </div>
            </div>

            {{-- Text side --}}
            <div class="lg:flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-gradient-to-r from-pink-100 to-pink-100
                             text-pink-700 mb-5">
                    ✦ How We Started
                </span>
                <h2 class="font-black text-gray-800 leading-tight mb-6"
                    style="font-size: clamp(1.8rem, 3.5vw, 2.8rem)">
                    From a Small Studio to<br>
                    <span class="bg-pink-500 bg-clip-text text-transparent">
                        Nigeria's Print Hub
                    </span>
                </h2>
                <div class="space-y-4 text-gray-600 text-sm leading-relaxed">
                    <p>
                        PrintBuka started as a passion project inside the production floors of
                        <strong class="text-gray-800">Alet Inspirationz Prints Limited</strong> — a commercial
                        print powerhouse that had already served hundpinks of corporate clients across Lagos.
                    </p>
                    <p>
                        We noticed a gap: individuals, small teams, and growing businesses couldn't access the
                        same quality of custom print and gifting that large corporations could. Minimum orders
                        were in the hundpinks, lead times were long, and the process was opaque.
                    </p>
                    <p>
                        So we built PrintBuka — a consumer-facing platform powepink by the same industrial-grade
                        equipment, staffed by the same expert team, but designed to serve everyone from a bride
                        ordering personalised mugs to a startup printing 10 branded hoodies.
                    </p>
                    <p>
                        Today, PrintBuka handles thousands of orders across DTF apparel, UV DTF hard-surface
                        printing, laser engraving, direct image printing, and custom gift curation —
                        with a digital-first ordering experience and real-time job tracking.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 mt-8">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white
                              bg-pink-600
                              hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-sm shadow-pink-200">
                        Start an Order
                    </a>
                    <a href="{{ url('/contact') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-gray-700
                              border border-gray-200 hover:border-gray-800 hover:bg-gray-800 hover:text-white
                              transition-all duration-200">
                        Talk to Us
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     NUMBERS / STATS
════════════════════════════════════════════════ --}}
<section class="bg-pink-600 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center text-white">
            @foreach([
                ['200+',   'Customisable Products'],
                ['1,000+', 'Orders Fulfilled'],
                ['4',      'Print Technologies'],
                ['24–72h', 'Average Turnaround'],
            ] as [$num, $label])
            <div>
                <p class="font-black text-4xl sm:text-5xl mb-1">{{ $num }}</p>
                <p class="text-white/70 text-xs font-medium uppercase tracking-wide">{{ $label }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     HOW WE WORK — PROCESS
════════════════════════════════════════════════ --}}
<section class="bg-white py-20 sm:py-28 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                         tracking-widest uppercase bg-gradient-to-r from-pink-100 to-pink-100 text-pink-700 mb-4">
                ✦ How It Works
            </span>
            <h2 class="font-black text-gray-800" style="font-size: clamp(1.8rem, 3.5vw, 2.8rem)">
                From Order to<br>
                <span class="bg-gradient-to-r from-pink-600 to-pink-600 bg-clip-text text-transparent">
                    Your Door
                </span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['01', 'bg-pink-600',     'Place Your Order',      'Browse our catalog, pick your product, upload your design or brief, and check out online. No phone calls needed.'],
                ['02', 'bg-pink-600', 'Design & Proof',        'Our designers prepare your artwork. You review and approve a digital proof before anything goes to print — always.'],
                ['03', 'bg-yellow-500',  'Production & QC',       'Your order goes into production on our industrial equipment. Every piece passes quality control before packaging.'],
                ['04', 'bg-gray-800',    'Delivery or Pickup',    'We deliver Nigeria-wide or you can pick up from our Lagos studio. Track your order status in real time.'],
            ] as [$step, $color, $title, $body])
            <div class="relative">
                <div class="w-12 h-12 rounded-2xl {{ $color }} flex items-center justify-center mb-5">
                    <span class="font-black text-white text-base">{{ $step }}</span>
                </div>
                {{-- Connector line --}}
                @if($step !== '04')
                <div class="hidden lg:block absolute top-6 left-12 right-0 h-0.5 bg-gradient-to-r from-gray-200 to-transparent"></div>
                @endif
                <h3 class="font-bold text-gray-800 text-base mb-2">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $body }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════════
     PARENT COMPANY
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="bg-gray-900 rounded-3xl p-8 sm:p-12 flex flex-col lg:flex-row items-center gap-10">
            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-white/10 border border-white/20 text-white/60 mb-5">
                    ✦ Powepink By
                </span>
                <h2 class="font-black text-white text-2xl sm:text-3xl mb-4 leading-snug">
                    Alet Inspirationz<br>Prints Limited
                </h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-6 max-w-lg">
                    PrintBuka is the consumer arm of Alet Inspirationz Prints Limited — a full-service
                    commercial print company based in Lagos, Nigeria. Alet handles large-format offset
                    printing, corporate stationery, branded packaging, promotional materials, and
                    industrial print production for major organisations across Nigeria.
                </p>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Offset Printing', 'Corporate Stationery', 'Branded Packaging', 'Promotional Materials', 'Industrial Print'] as $tag)
                    <span class="text-xs font-semibold text-gray-400 border border-gray-700 rounded-full px-3 py-1.5">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url('/bulk-orders') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-sm font-bold text-gray-900
                          bg-gradient-to-r from-yellow-400 to-yellow-300
                          hover:-translate-y-0.5 hover:shadow-lg hover:shadow-yellow-500/30 transition-all duration-200">
                    Enquire About Bulk Orders
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     CTA
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10 border-t border-gray-100">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-4">Ready to Create Something?</h2>
        <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-xl mx-auto">
            Browse our services, place your order online, and let our team handle the rest.
            Quality guaranteed, proof before print, always.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('shop') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold text-white
                      bg-pink-600
                      hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-sm shadow-pink-200">
                Browse Products
            </a>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold text-gray-700
                      border border-gray-200 hover:border-gray-800 hover:bg-gray-800 hover:text-white
                      transition-all duration-200">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection