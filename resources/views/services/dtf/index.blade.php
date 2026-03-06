{{--
    resources/views/pages/services/dtf.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'DTF T-Shirt & Apparel Printing | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=1600&auto=format&fit=crop&q=80"
             alt="DTF T-Shirt Printing"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">

        <nav class="flex items-center gap-1.5 text-xs text-white/40 mb-7">
            <a href="{{ url('/') }}" class="hover:text-white/70 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ url('/services') }}" class="hover:text-white/70 transition-colors">Services</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60">DTF Printing</span>
        </nav>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                     tracking-widest uppercase bg-red-600/20 border border-red-500/30 text-red-400 mb-5">
            ✦ Service 01
        </span>
        <h1 class="font-black text-white leading-[1.05] mb-5"
            style="font-size: clamp(2.2rem, 5vw, 4rem)">
            DTF T-Shirt &amp;<br>
            <span class="bg-gradient-to-r from-red-400 to-fuchsia-400 bg-clip-text text-transparent">
                Apparel Printing
            </span>
        </h1>
        <p class="text-white/60 text-base leading-relaxed max-w-lg mb-8">
            Full-colour, wash-resistant prints on any fabric type. No minimum quantity, no compromises.
            Direct-to-Film technology that delivers professional-grade results every time.
        </p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/shop?category=tshirts') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white
                      bg-red-600 hover:bg-red-700 transition-colors duration-150 shadow-lg">
                Order DTF Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white
                      border border-white/30 hover:bg-white/10 transition-colors duration-150">
                Get a Quote
            </a>
        </div>

        {{-- Quick stats --}}
        <div class="flex flex-wrap gap-6 mt-12 pt-10 border-t border-white/10">
            @foreach(['Min. 1 Piece','24–48h Turnaround','Any Fabric Type','Full Colour Prints','Wash-Resistant','Free Digital Proof'] as $stat)
            <div class="flex items-center gap-2 text-sm text-white/60">
                <svg class="w-4 h-4 text-red-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                {{ $stat }}
            </div>
            @endforeach
        </div>
    </div>
    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>


{{-- ════════════════════════════════════════════════
     WHAT IS DTF?
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20 items-center">

            <div class="lg:w-[48%]">
                <div class="rounded-2xl overflow-hidden shadow-xl shadow-gray-200/50">
                    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=800&auto=format&fit=crop&q=80"
                         alt="DTF print process"
                         class="w-full object-cover" style="aspect-ratio: 4/3">
                </div>
            </div>

            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-red-100 text-red-700 mb-4">
                    ✦ The Technology
                </span>
                <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-5 leading-snug">
                    What is Direct-to-Film<br>
                    <span class="bg-gradient-to-r from-red-600 to-fuchsia-600 bg-clip-text text-transparent">(DTF) Printing?</span>
                </h2>
                <div class="space-y-3 text-gray-600 text-sm leading-relaxed mb-7">
                    <p>
                        DTF (Direct-to-Film) printing works by printing your design onto a special film sheet
                        using high-quality pigment inks. The film is then coated with a hot-melt adhesive powder
                        and cured in an oven.
                    </p>
                    <p>
                        The finished transfer is then heat-pressed onto your garment at the correct temperature
                        and pressure — creating a bond that is vibrant, flexible, and remarkably wash-resistant,
                        even after hundreds of washes.
                    </p>
                    <p>
                        Unlike screen printing, DTF has <strong class="text-gray-800">no colour limits</strong> and
                        no setup fees — making it ideal for short runs, one-offs, and complex multicolour designs.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['✅','No colour limits','Full CMYK + white underbase'],
                        ['✅','No minimum order','From a single piece'],
                        ['✅','Works on dark fabrics','White underbase included'],
                        ['✅','Wash-resistant','60°C wash tested'],
                    ] as [$icon,$title,$sub])
                    <div class="bg-red-50 border border-red-100 rounded-xl p-3">
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
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">What We Print On</h2>
            <p class="text-gray-500 text-sm">DTF works on virtually any fabric type</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['👕','T-Shirts','Cotton, polyester, blends'],
                ['🧥','Hoodies','All weights'],
                ['👔','Polos','Corporate & sports'],
                ['🎓','Caps','Structured & unstructured'],
                ['👜','Tote Bags','Canvas & non-woven'],
                ['⚽','Jerseys','Sports & team kits'],
            ] as [$emoji,$name,$sub])
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center hover:-translate-y-1 hover:shadow-md transition-all duration-200">
                <p class="text-3xl mb-2">{{ $emoji }}</p>
                <p class="font-bold text-gray-800 text-xs mb-0.5">{{ $name }}</p>
                <p class="text-gray-400 text-[10px]">{{ $sub }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     PRICING
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Simple Pricing</h2>
            <p class="text-gray-500 text-sm">No hidden fees. Prices decrease with volume.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
            @foreach([
                ['1–4 pieces',  '₦2,200',  '/pc', 'Per Piece','red',   false],
                ['5–19 pieces', '₦1,900',  '/pc', 'Per Piece','fuchsia',true],
                ['20+ pieces',  '₦1,600',  '/pc', 'Per Piece','gray',  false],
            ] as [$qty,$price,$per,$label,$color,$popular])
            <div class="relative border rounded-2xl p-6 text-center {{ $popular ? 'border-fuchsia-300 shadow-xl shadow-fuchsia-100' : 'border-gray-100' }}">
                @if($popular)
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-fuchsia-600 text-white text-[10px] font-extrabold">
                    Most Popular
                </span>
                @endif
                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">{{ $qty }}</p>
                <p class="font-black text-gray-800 mb-1" style="font-size: 2.2rem">{{ $price }}<span class="text-sm text-gray-400 font-medium">{{ $per }}</span></p>
                <p class="text-xs text-gray-400">{{ $label }}</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-gray-400 mt-5">Prices are for A4 chest print area. Larger print areas, all-over prints, or special fabrics may vary. <a href="{{ url('/contact') }}" class="text-red-600 hover:underline">Request a custom quote.</a></p>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     HOW TO ORDER
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">How to Order DTF</h2>
            <p class="text-gray-500 text-sm">Four simple steps from idea to finished product</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['01','bg-red-600',    'Browse & Select','Choose your garment type, colour, and size from our catalog.'],
                ['02','bg-fuchsia-600','Upload Design',   'Upload your artwork — PNG, AI, PDF, or send us a brief.'],
                ['03','bg-yellow-500', 'Approve Proof',   'We send a digital mock-up for your sign-off before printing.'],
                ['04','bg-gray-800',   'We Deliver',      'Your order is printed, quality-checked, and dispatched to you.'],
            ] as [$n,$bg,$title,$body])
            <div class="relative">
                <div class="w-11 h-11 rounded-2xl {{ $bg }} flex items-center justify-center mb-4">
                    <span class="font-black text-white text-sm">{{ $n }}</span>
                </div>
                @if($n !== '04')
                <div class="hidden lg:block absolute top-5 left-11 right-0 h-0.5 bg-gradient-to-r from-gray-200 to-transparent"></div>
                @endif
                <h3 class="font-bold text-gray-800 text-sm mb-1.5">{{ $title }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $body }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- CTA --}}
<section class="bg-gradient-to-r from-red-600 to-fuchsia-600 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-3xl mb-3">Ready to Print Your Design?</h2>
        <p class="text-white/75 text-sm mb-7">Min. 1 piece. Free proof. Fast turnaround. No excuses.</p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/shop?category=tshirts') }}"
               class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                      text-red-700 bg-white hover:bg-gray-50 transition-colors">
                Order Now
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