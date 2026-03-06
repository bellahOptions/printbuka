{{--
    resources/views/pages/services/laser.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'Mini Laser Engraving — Precision Personalisation | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600&auto=format&fit=crop&q=80"
             alt="Laser Engraving"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">

        <nav class="flex items-center gap-1.5 text-xs text-white/40 mb-7">
            <a href="{{ url('/') }}" class="hover:text-white/70 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ url('/services') }}" class="hover:text-white/70 transition-colors">Services</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60">Laser Engraving</span>
        </nav>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                     tracking-widest uppercase bg-yellow-500/20 border border-yellow-500/30 text-yellow-400 mb-5">
            ✦ Service 03
        </span>

        <h1 class="font-black text-white leading-[1.05] mb-5"
            style="font-size: clamp(2.2rem, 5vw, 4rem)">
            Mini Laser Engraving —<br>
            <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">
                Precision Cut into Forever.
            </span>
        </h1>

        <p class="text-white/60 text-base leading-relaxed max-w-lg mb-8">
            Permanent, elegant personalisation etched directly into wood, metal, leather, glass,
            and acrylic. No ink. No fading. Just flawless precision that lasts a lifetime.
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/shop?category=laser') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-gray-900
                      bg-yellow-400 hover:bg-yellow-500 transition-colors duration-150 shadow-lg">
                Order Engraving Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white
                      border border-white/30 hover:bg-white/10 transition-colors duration-150">
                Get a Quote
            </a>
        </div>

        <div class="flex flex-wrap gap-5 mt-12 pt-10 border-t border-white/10">
            @foreach(['Min. 1 Piece','24–48h Turnaround','5 Material Types','Permanent Mark','No Ink or Paint','Free Artwork Prep'] as $f)
            <div class="flex items-center gap-2 text-sm text-white/60">
                <svg class="w-4 h-4 text-yellow-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                {{ $f }}
            </div>
            @endforeach
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>


{{-- ════════════════════════════════════════════════
     WHAT IS LASER ENGRAVING?
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20 items-center">

            <div class="lg:w-[48%]">
                <div class="rounded-2xl overflow-hidden shadow-xl shadow-gray-200/50">
                    <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&auto=format&fit=crop&q=80"
                         alt="Laser engraved wood and acrylic"
                         class="w-full object-cover" style="aspect-ratio: 4/3">
                </div>
            </div>

            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-yellow-100 text-yellow-700 mb-4">
                    ✦ The Technology
                </span>
                <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-5 leading-snug">
                    How Does<br>
                    <span class="bg-gradient-to-r from-yellow-500 to-orange-500 bg-clip-text text-transparent">
                        Laser Engraving Work?
                    </span>
                </h2>
                <div class="space-y-3 text-gray-600 text-sm leading-relaxed mb-7">
                    <p>
                        A high-powered laser beam is precisely directed across the surface of your material,
                        vaporising or ablating the top layer to create a permanent impression. The depth,
                        speed, and intensity of the laser are calibrated to the exact material being engraved.
                    </p>
                    <p>
                        The result is a crisp, tactile mark that is part of the material itself — not a
                        sticker, not ink, not paint. It cannot peel, fade, scratch off, or wash away.
                    </p>
                    <p>
                        Our <strong class="text-gray-800">mini laser engraver</strong> is ideal for
                        small to medium items — keychains, plaques, pens, gifts, trophies, nameplates,
                        and personalised accessories — with extraordinary precision down to sub-millimetre detail.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['✅','Permanent mark',     'Cannot fade or peel ever'],
                        ['✅','Sub-mm precision',   'Intricate text and logos'],
                        ['✅','No consumables',     'No ink, no paint used'],
                        ['✅','Works on 5+ surfaces','Wood, metal, glass, leather, acrylic'],
                    ] as [$icon,$title,$sub])
                    <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-3">
                        <p class="font-bold text-gray-800 text-xs mb-0.5">{{ $icon }} {{ $title }}</p>
                        <p class="text-gray-500 text-[11px]">{{ $sub }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     MATERIALS WE ENGRAVE
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Materials We Engrave</h2>
            <p class="text-gray-500 text-sm">Each material produces a distinct and beautiful finish</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
            @foreach([
                ['🪵','Wood',    'Natural warm burn mark. Perfect for plaques, frames, keychains, and rustic gifts.','Natural brown char on wood grain'],
                ['🔩','Metal',   'Clean silver or gold-toned etch on aluminium, stainless steel, brass, and more.','Reflective contrast finish'],
                ['👜','Leather', 'Rich, permanent impression that deepens over time on genuine and faux leather.','Elegant debossed effect'],
                ['🪟','Glass',   'Frosted etching on clear or tinted glass — bottles, frames, windows, awards.','Frosted white frost finish'],
                ['💎','Acrylic', 'Crystal-clear frosted marks on transparent or coloured acrylic sheets and items.','Frosted precision detail'],
            ] as [$emoji,$mat,$desc,$finish])
            <div class="bg-white border border-gray-100 rounded-2xl p-5
                        hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-100/50
                        hover:border-yellow-200 transition-all duration-200">
                <p class="text-3xl mb-3">{{ $emoji }}</p>
                <h3 class="font-bold text-gray-800 text-base mb-1.5">{{ $mat }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed mb-3">{{ $desc }}</p>
                <span class="inline-block px-2.5 py-1 text-[10px] font-bold text-yellow-700
                             bg-yellow-50 border border-yellow-100 rounded-full">
                    {{ $finish }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     POPULAR PRODUCTS
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Popular Engraved Items</h2>
            <p class="text-gray-500 text-sm">Our most-ordered laser engraving products</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['🏆','Award Plaques',      'From ₦5,500','Acrylic & wood'],
                ['🔑','Keychains',          'From ₦2,000','Metal & wood'],
                ['🖊️','Engraved Pens',      'From ₦3,200','Metal sets'],
                ['📋','Name Plates',        'From ₦4,500','Brass & aluminium'],
                ['🪵','Wooden Gifts',       'From ₦6,000','Frames & boxes'],
                ['🎖️','Medals & Trophies',  'From ₦7,500','Custom design'],
            ] as [$emoji,$name,$price,$sub])
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 text-center
                        hover:border-yellow-200 hover:bg-yellow-50/50 hover:-translate-y-1
                        hover:shadow-md transition-all duration-200">
                <p class="text-3xl mb-2">{{ $emoji }}</p>
                <p class="font-bold text-gray-800 text-xs mb-0.5">{{ $name }}</p>
                <p class="text-yellow-600 font-black text-sm mb-0.5">{{ $price }}</p>
                <p class="text-gray-400 text-[10px]">{{ $sub }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     PRICING
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Pricing Guide</h2>
            <p class="text-gray-500 text-sm">Price varies by item size, material, and design complexity</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
            @foreach([
                ['Standard Items',  '₦2,000',  'Keychains, pens, tags',            false],
                ['Medium Items',    '₦5,500',  'Plaques, frames, name plates',      true],
                ['Premium Items',   '₦7,500+', 'Trophies, large acrylic, sets',     false],
            ] as [$tier,$price,$examples,$popular])
            <div class="relative bg-white border rounded-2xl p-7 text-center
                        {{ $popular ? 'border-yellow-300 shadow-xl shadow-yellow-100/60' : 'border-gray-100' }}">
                @if($popular)
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full
                             bg-yellow-500 text-white text-[10px] font-extrabold whitespace-nowrap">
                    Most Popular
                </span>
                @endif
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">{{ $tier }}</p>
                <p class="font-black text-gray-800 mb-1" style="font-size: 2.2rem">{{ $price }}</p>
                <p class="text-xs text-gray-400">{{ $examples }}</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-gray-400 mt-5">
            Bulk orders of 10+ pieces receive a 15% discount.
            <a href="{{ url('/contact') }}" class="text-yellow-600 hover:underline">Get a custom quote →</a>
        </p>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     HOW TO ORDER
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">How to Order</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['01','bg-yellow-500',   'Pick Your Item',      'Choose from our catalog of engravable items or tell us what you want engraved.'],
                ['02','bg-fuchsia-600',  'Send Your Text/Logo', 'Provide the name, quote, or logo to be engraved. We handle artwork formatting.'],
                ['03','bg-red-600',      'Approve the Preview', 'We send a digital placement preview. You confirm before the laser touches anything.'],
                ['04','bg-gray-800',     'Receive Your Order',  'Engraved, inspected, carefully packed, and delivered to you within 24–48 hours.'],
            ] as [$n,$bg,$title,$body])
            <div class="relative">
                <div class="w-11 h-11 rounded-2xl {{ $bg }} flex items-center justify-center mb-4 shrink-0">
                    <span class="font-black text-white text-sm">{{ $n }}</span>
                </div>
                @if($n !== '04')
                <div class="hidden lg:block absolute top-5 left-11 right-0 h-px bg-gradient-to-r from-gray-200 to-transparent"></div>
                @endif
                <h3 class="font-bold text-gray-800 text-sm mb-1.5">{{ $title }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     USE CASES
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Perfect For</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['🏆','Corporate Awards',    'Custom trophies, plaques, and recognition gifts for employee milestones, events, and ceremonies.','yellow'],
                ['💒','Weddings & Events',   'Personalised keepsakes, engraved wedding favours, unity gifts, and event memorabilia.','fuchsia'],
                ['🎓','Graduations',         'Commemorative wooden frames, engraved pens, and keychains marking academic achievements.','red'],
                ['🏗️','Business Branding',   'Branded name plates, desk accessories, executive pen sets, and client gift sets.','yellow'],
                ['🎁','Special Gifts',       'Deeply personal presents for birthdays, retirements, and anniversaries — names, dates, memories.','fuchsia'],
                ['🏅','Sports & Clubs',      'Custom medals, trophies, and plaques for tournaments, league champions, and team recognition.','red'],
            ] as [$emoji,$title,$body,$color])
            @php $ci = ['red'=>'bg-red-100','fuchsia'=>'bg-fuchsia-100','yellow'=>'bg-yellow-100']; @endphp
            <div class="bg-white border border-gray-100 rounded-2xl p-5
                        hover:-translate-y-1 hover:shadow-lg hover:shadow-gray-200/60 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl {{ $ci[$color] }} flex items-center justify-center text-xl mb-4">{{ $emoji }}</div>
                <h3 class="font-bold text-gray-800 text-base mb-2">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- CTA --}}
<section class="bg-gradient-to-r from-yellow-500 via-orange-500 to-red-600 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-3xl mb-3">Engrave Something Meaningful</h2>
        <p class="text-white/80 text-sm mb-7">Min. 1 piece · Free artwork prep · Permanent results · Fast turnaround</p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/shop?category=laser') }}"
               class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                      text-yellow-700 bg-white hover:bg-gray-50 transition-colors">
                Order Engraving
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                      text-white border-2 border-white/40 hover:bg-white/10 transition-colors">
                Get a Quote
            </a>
        </div>
    </div>
</section>

@endsection