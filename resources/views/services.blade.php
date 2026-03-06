{{--
    resources/views/pages/services.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'Our Services — Print Technologies | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 border-b border-gray-100 py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-7">
            <a href="{{ url('/') }}" class="hover:text-gray-600 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 font-medium">Services</span>
        </nav>
        <div class="max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                         tracking-widest uppercase bg-gradient-to-r from-red-100 to-fuchsia-100
                         text-fuchsia-700 mb-4">
                ✦ What We Offer
            </span>
            <h1 class="font-black text-gray-800 leading-tight mb-4"
                style="font-size: clamp(2rem, 5vw, 3.5rem)">
                Four Technologies.<br>
                <span class="bg-gradient-to-r from-red-600 to-fuchsia-600 bg-clip-text text-transparent">
                    Endless Possibilities.
                </span>
            </h1>
            <p class="text-gray-500 text-sm leading-relaxed">
                Every print method we use is chosen for a reason — the right technology for the
                right surface, the right product, the right outcome. Explore what we do and how we do it.
            </p>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     SERVICES GRID
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 sm:py-24 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-7">

            {{-- ── DTF T-Shirt Printing ── --}}
            <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden
                        hover:shadow-2xl hover:shadow-gray-200/60 hover:-translate-y-1 transition-all duration-300">
                <div class="h-52 overflow-hidden bg-red-50">
                    <img src="https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=800&auto=format&fit=crop&q=80"
                         alt="DTF T-Shirt Printing"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 h-52 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-red-600 text-white text-[10px] font-extrabold tracking-widest uppercase">
                        DTF Printing
                    </span>
                </div>
                <div class="p-7">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="font-black text-gray-800 text-xl sm:text-2xl mb-1">T-Shirt &amp; Apparel Printing</h2>
                            <p class="text-xs text-gray-400 font-medium">Direct-to-Film Technology</p>
                        </div>
                        <span class="font-black text-5xl leading-none text-red-100 select-none -mt-2">01</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">
                        Full-colour, high-definition prints on any fabric type. Our DTF process produces
                        vibrant, wash-resistant designs with incredible detail — from photographic prints
                        to intricate logos. Perfect for corporate uniforms, team kits, event merch, and
                        personal fashion. <strong class="text-gray-800">Minimum 1 piece.</strong>
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['T-Shirts','Hoodies','Polos','Caps','Tote Bags','Jerseys'] as $item)
                        <span class="px-2.5 py-1 text-[10px] font-semibold text-red-700 bg-red-50 rounded-full border border-red-100">{{ $item }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/services/dtf') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white
                                  bg-red-600 hover:bg-red-700 transition-colors duration-150">
                            Learn More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url('/shop?category=tshirts') }}"
                           class="text-sm font-bold text-red-600 hover:text-red-700 transition-colors">
                            Shop DTF →
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── UV DTF Printing ── --}}
            <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden
                        hover:shadow-2xl hover:shadow-gray-200/60 hover:-translate-y-1 transition-all duration-300">
                <div class="h-52 overflow-hidden bg-fuchsia-50">
                    <img src="https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=800&auto=format&fit=crop&q=80"
                         alt="UV DTF Printing"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 h-52 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-fuchsia-600 text-white text-[10px] font-extrabold tracking-widest uppercase">
                        UV DTF
                    </span>
                </div>
                <div class="p-7">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="font-black text-gray-800 text-xl sm:text-2xl mb-1">UV DTF Printing</h2>
                            <p class="text-xs text-gray-400 font-medium">Hard Surface Technology</p>
                        </div>
                        <span class="font-black text-5xl leading-none text-fuchsia-100 select-none -mt-2">02</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">
                        Ultra-precise UV DTF transfers bring full-colour, textured prints to any hard surface.
                        The result is scratch-resistant and waterproof — perfect for premium branded merchandise
                        and personalised gifts that need to last.
                        <strong class="text-gray-800">Minimum 1 piece.</strong>
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['Tumblers','Bottles','Mugs','Phone Cases','Lids','Cups'] as $item)
                        <span class="px-2.5 py-1 text-[10px] font-semibold text-fuchsia-700 bg-fuchsia-50 rounded-full border border-fuchsia-100">{{ $item }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/services/uvdtf') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white
                                  bg-fuchsia-600 hover:bg-fuchsia-700 transition-colors duration-150">
                            Learn More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url('/shop?category=uvdtf') }}"
                           class="text-sm font-bold text-fuchsia-600 hover:text-fuchsia-700 transition-colors">
                            Shop UV DTF →
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Laser Engraving ── --}}
            <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden
                        hover:shadow-2xl hover:shadow-gray-200/60 hover:-translate-y-1 transition-all duration-300">
                <div class="h-52 overflow-hidden bg-yellow-50">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&auto=format&fit=crop&q=80"
                         alt="Laser Engraving"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 h-52 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-yellow-500 text-white text-[10px] font-extrabold tracking-widest uppercase">
                        Laser
                    </span>
                </div>
                <div class="p-7">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="font-black text-gray-800 text-xl sm:text-2xl mb-1">Mini Laser Engraving</h2>
                            <p class="text-xs text-gray-400 font-medium">Precision Etching Technology</p>
                        </div>
                        <span class="font-black text-5xl leading-none text-yellow-100 select-none -mt-2">03</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">
                        Permanent, elegant personalisation etched directly into the material — no ink, no
                        fading. Our mini laser engraver handles intricate detail with stunning precision
                        on wood, metal, leather, glass, and acrylic.
                        <strong class="text-gray-800">Minimum 1 piece.</strong>
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['Wood','Metal','Leather','Glass','Acrylic','Slate'] as $item)
                        <span class="px-2.5 py-1 text-[10px] font-semibold text-yellow-700 bg-yellow-50 rounded-full border border-yellow-100">{{ $item }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/services/laser') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-gray-900
                                  bg-yellow-400 hover:bg-yellow-500 transition-colors duration-150">
                            Learn More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url('/shop?category=laser') }}"
                           class="text-sm font-bold text-yellow-600 hover:text-yellow-700 transition-colors">
                            Shop Engraving →
                        </a>
                    </div>
                </div>
            </div>

            {{-- ── Direct Image Printing ── --}}
            <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden
                        hover:shadow-2xl hover:shadow-gray-200/60 hover:-translate-y-1 transition-all duration-300">
                <div class="h-52 overflow-hidden bg-orange-50">
                    <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=800&auto=format&fit=crop&q=80"
                         alt="Direct Image Printing"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 h-52 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 rounded-full bg-orange-600 text-white text-[10px] font-extrabold tracking-widest uppercase">
                        Direct Image
                    </span>
                </div>
                <div class="p-7">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="font-black text-gray-800 text-xl sm:text-2xl mb-1">Direct Image Printing</h2>
                            <p class="text-xs text-gray-400 font-medium">Substrate-Direct Technology</p>
                        </div>
                        <span class="font-black text-5xl leading-none text-orange-100 select-none -mt-2">04</span>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">
                        High-resolution printing directly onto rigid and flexible substrates without
                        transfers. Produces sharp, photographic-quality images on canvas, foam board,
                        signage, and display items — ideal for events, exhibits, and photo gifts.
                        <strong class="text-gray-800">Minimum 1 piece.</strong>
                    </p>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach(['Canvas','Foam Board','Signage','Banners','Photo Tiles','Boards'] as $item)
                        <span class="px-2.5 py-1 text-[10px] font-semibold text-orange-700 bg-orange-50 rounded-full border border-orange-100">{{ $item }}</span>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/services/direct-image') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white
                                  bg-orange-600 hover:bg-orange-700 transition-colors duration-150">
                            Learn More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url('/shop?category=direct-image') }}"
                           class="text-sm font-bold text-orange-600 hover:text-orange-700 transition-colors">
                            Shop Direct Image →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     COMPARISON TABLE
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Which Service Is Right for You?</h2>
            <p class="text-gray-500 text-sm">Quick comparison to help you choose.</p>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
            <table class="w-full min-w-[640px] bg-white text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left px-5 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest w-40">Feature</th>
                        <th class="px-5 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-extrabold">DTF Printing</span>
                        </th>
                        <th class="px-5 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full bg-fuchsia-100 text-fuchsia-700 text-xs font-extrabold">UV DTF</span>
                        </th>
                        <th class="px-5 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-extrabold">Laser</span>
                        </th>
                        <th class="px-5 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-extrabold">Direct Image</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach([
                        ['Best For',        'Fabric / Apparel', 'Hard Surfaces',    'Wood, Metal, Glass', 'Rigid / Flat Boards'],
                        ['Colour Output',   'Full Colour',      'Full Colour + 3D',  'Monochrome Etch',    'Full Colour Photo'],
                        ['Durability',      'Wash-Resistant',   'Scratch & Waterproof','Permanent',        'Indoor Use'],
                        ['Min. Order',      '1 Piece',          '1 Piece',           '1 Piece',            '1 Piece'],
                        ['Turnaround',      '24–48h',           '24–72h',            '24–48h',             '24–72h'],
                        ['Starting Price',  '₦1,900',           '₦2,800',            '₦2,000',             '₦4,500'],
                    ] as [$feature, $dtf, $uvdtf, $laser, $direct])
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wide">{{ $feature }}</td>
                        <td class="px-5 py-3.5 text-center text-xs text-gray-700 font-medium">{{ $dtf }}</td>
                        <td class="px-5 py-3.5 text-center text-xs text-gray-700 font-medium">{{ $uvdtf }}</td>
                        <td class="px-5 py-3.5 text-center text-xs text-gray-700 font-medium">{{ $laser }}</td>
                        <td class="px-5 py-3.5 text-center text-xs text-gray-700 font-medium">{{ $direct }}</td>
                    </tr>
                    @endforeach
                    <tr class="bg-gray-50">
                        <td class="px-5 py-4"></td>
                        @foreach([['/services/dtf','bg-red-600'],['/services/uvdtf','bg-fuchsia-600'],['/services/laser','bg-yellow-500'],['/services/direct-image','bg-orange-600']] as [$href,$bg])
                        <td class="px-5 py-4 text-center">
                            <a href="{{ url($href) }}"
                               class="inline-flex items-center justify-center px-4 py-1.5 rounded-lg text-xs font-bold text-white
                                      {{ $bg }} hover:opacity-90 transition-opacity">
                                Order
                            </a>
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</section>


{{-- CTA --}}
<section class="bg-gradient-to-r from-red-600 via-fuchsia-600 to-fuchsia-700 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-3xl mb-3">Not sure which service you need?</h2>
        <p class="text-white/75 text-sm mb-7">Tell us what you want to create and we'll recommend the best approach.</p>
        <a href="{{ url('/contact') }}"
           class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                  text-fuchsia-700 bg-white hover:bg-gray-50 transition-colors duration-150">
            Talk to Our Team
        </a>
    </div>
</section>

@endsection