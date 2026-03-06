{{--
    resources/views/pages/services/direct-image.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'Direct Image Printing — High-Res Substrate Printing | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&auto=format&fit=crop&q=80"
             alt="Direct Image Printing"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">

        <nav class="flex items-center gap-1.5 text-xs text-white/40 mb-7">
            <a href="{{ url('/') }}" class="hover:text-white/70 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ url('/services') }}" class="hover:text-white/70 transition-colors">Services</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60">Direct Image</span>
        </nav>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                     tracking-widest uppercase bg-orange-600/20 border border-orange-500/30 text-orange-400 mb-5">
            ✦ Service 04
        </span>

        <h1 class="font-black text-white leading-[1.05] mb-5"
            style="font-size: clamp(2.2rem, 5vw, 4rem)">
            Direct Image Printing —<br>
            <span class="bg-gradient-to-r from-orange-400 to-yellow-300 bg-clip-text text-transparent">
                Photo-Perfect on Any Surface.
            </span>
        </h1>

        <p class="text-white/60 text-base leading-relaxed max-w-lg mb-8">
            High-resolution, photographic-quality printing directly onto rigid and flexible substrates —
            no heat, no transfers. Sharp, vibrant results on canvas, foam board, signage, tiles, and more.
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/shop?category=direct-image') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white
                      bg-orange-600 hover:bg-orange-700 transition-colors duration-150 shadow-lg">
                Order Direct Image
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
            @foreach(['Min. 1 Piece','24–72h Turnaround','Photo Quality Output','No Transfers Needed','Rigid & Flexible','Free Artwork Check'] as $f)
            <div class="flex items-center gap-2 text-sm text-white/60">
                <svg class="w-4 h-4 text-orange-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
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
     WHAT IS DIRECT IMAGE PRINTING?
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20 items-center">

            <div class="lg:w-[48%]">
                <div class="rounded-2xl overflow-hidden shadow-xl shadow-gray-200/50">
                    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=800&auto=format&fit=crop&q=80"
                         alt="Direct image print output"
                         class="w-full object-cover" style="aspect-ratio: 4/3">
                </div>
            </div>

            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-orange-100 text-orange-700 mb-4">
                    ✦ The Technology
                </span>
                <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-5 leading-snug">
                    What Is<br>
                    <span class="bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                        Direct Image Printing?
                    </span>
                </h2>
                <div class="space-y-3 text-gray-600 text-sm leading-relaxed mb-7">
                    <p>
                        Direct image printing (also called direct-to-substrate or flatbed printing) uses
                        a UV-cured inkjet system to print your design directly onto the surface of an item
                        — without any intermediate transfer film or heat press.
                    </p>
                    <p>
                        The print head moves across the substrate, depositing tiny ink droplets that are
                        immediately cured by a UV lamp, creating an instantly dry, hard-wearing surface
                        with photo-realistic quality and outstanding colour accuracy.
                    </p>
                    <p>
                        It works on both <strong class="text-gray-800">rigid surfaces</strong> (boards,
                        tiles, canvas panels, wood slabs) and <strong class="text-gray-800">flexible
                        materials</strong> (banner vinyl, fabric panels, flexible foam). No size minimums,
                        no colour limits.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['✅','Photo-quality resolution','300–1440 DPI output'],
                        ['✅','UV-cured instantly',       'No drying time required'],
                        ['✅','Works on thick substrates','Up to 10cm depth clearance'],
                        ['✅','No size minimums',         'From A5 to large format'],
                    ] as [$icon,$title,$sub])
                    <div class="bg-orange-50 border border-orange-100 rounded-xl p-3">
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
     WHAT WE PRINT ON
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Substrates We Print On</h2>
            <p class="text-gray-500 text-sm">Rigid, flexible, and everything in between</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['🖼️','Canvas Prints',  'Stretched or rolled canvas'],
                ['📐','Foam Board',     'Lightweight, vivid display'],
                ['🪟','Acrylic Panels', 'Crystal-clear print backing'],
                ['🪵','Wood Slabs',     'Rustic branded displays'],
                ['🧱','Ceramic Tiles',  'Photo tiles for décor'],
                ['📋','PVC Boards',     'Outdoor & signage use'],
            ] as [$emoji,$name,$sub])
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center
                        hover:-translate-y-1 hover:shadow-md hover:border-orange-200 transition-all duration-200">
                <p class="text-3xl mb-2">{{ $emoji }}</p>
                <p class="font-bold text-gray-800 text-xs mb-0.5">{{ $name }}</p>
                <p class="text-gray-400 text-[10px]">{{ $sub }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     USE CASES
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">What It's Used For</h2>
            <p class="text-gray-500 text-sm">From home décor to corporate interiors</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['🖼️','Photo Gifts',          'Canvas prints, photo tiles, framed prints — perfect for birthdays, anniversaries, and remembrances.','orange'],
                ['🏢','Office Interiors',      'Branded wall prints, reception panels, motivational artwork, and directional signage for workplaces.','red'],
                ['🎪','Event Displays',        'Custom backdrop panels, step-and-repeat boards, exhibition stands, and branded photo booth backdrops.','yellow'],
                ['🛒','Retail Signage',        'Price boards, product display panels, shelf talkers, and in-store promotional materials.','orange'],
                ['🏠','Home Décor',            'Custom canvas art, family portraits, personalised wall tiles, and interior feature pieces.','red'],
                ['📣','Outdoor Advertising',   'Weather-resistant PVC and foam board signage for estate agents, events, and local businesses.','yellow'],
            ] as [$emoji,$title,$body,$color])
            @php $ci = ['red'=>'bg-red-100','orange'=>'bg-orange-100','yellow'=>'bg-yellow-100']; @endphp
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5
                        hover:-translate-y-1 hover:shadow-lg hover:shadow-gray-200/60 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl {{ $ci[$color] }} flex items-center justify-center text-xl mb-4">{{ $emoji }}</div>
                <h3 class="font-bold text-gray-800 text-base mb-2">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $body }}</p>
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
            <p class="text-gray-500 text-sm">Prices are per item and vary by substrate type and print size</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
            @foreach([
                ['A4 Print',    '₦4,500',  'Canvas, foam board, acrylic',  false],
                ['A3 Print',    '₦7,500',  'Any substrate listed',         true],
                ['A2 & Larger', '₦12,000+','Large format on request',      false],
            ] as [$tier,$price,$examples,$popular])
            <div class="relative bg-white border rounded-2xl p-7 text-center
                        {{ $popular ? 'border-orange-300 shadow-xl shadow-orange-100/60' : 'border-gray-100' }}">
                @if($popular)
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full
                             bg-orange-600 text-white text-[10px] font-extrabold whitespace-nowrap">
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
            Multi-piece orders receive volume discounts. Custom substrates quoted separately.
            <a href="{{ url('/contact') }}" class="text-orange-600 hover:underline">Get a custom quote →</a>
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
                ['01','bg-orange-600', 'Choose Substrate',    'Tell us what you want to print on — canvas, foam board, acrylic, tiles, or bring your own.'],
                ['02','bg-red-600',    'Upload Your Image',   'Send your photo or artwork file. We accept JPG, PNG, PDF, and AI. We advise on resolution.'],
                ['03','bg-yellow-500', 'Approve the Preview', 'We prepare a colour-accurate digital mock-up for your sign-off before anything is printed.'],
                ['04','bg-gray-800',   'Receive It',          'Printed, quality-checked, and carefully packaged. Ready in 24–72h. Nationwide delivery.'],
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
     FILE REQUIREMENTS
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-12 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white border border-orange-100 rounded-2xl p-7">
            <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">📂</span>
                File Requirements for Best Results
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                @foreach([
                    ['Resolution','Minimum 150 DPI at print size. 300 DPI preferred for photo prints.'],
                    ['File Formats','PNG, JPG, PDF (print-ready), or AI/PSD layered files.'],
                    ['Colour Mode','RGB for screen output. CMYK for the most accurate colour match.'],
                    ['Bleed & Safe Zone','3mm bleed on all sides for edge-to-edge prints.'],
                ] as [$label,$value])
                <div class="border border-gray-100 rounded-xl p-3">
                    <p class="text-[10px] font-extrabold text-orange-500 uppercase tracking-widest mb-0.5">{{ $label }}</p>
                    <p class="text-gray-600 text-xs leading-relaxed">{{ $value }}</p>
                </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-4">
                Not sure if your file is ready? Send it to us anyway — our team will check it and advise you free of charge.
            </p>
        </div>
    </div>
</section>


{{-- CTA --}}
<section class="bg-gradient-to-r from-orange-600 via-red-600 to-fuchsia-700 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-3xl mb-3">Print Your Image, Your Way</h2>
        <p class="text-white/75 text-sm mb-7">
            Min. 1 piece · Photo-quality output · Any substrate · Nationwide delivery
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/shop?category=direct-image') }}"
               class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                      text-orange-700 bg-white hover:bg-gray-50 transition-colors">
                Order Direct Image
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