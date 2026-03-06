{{--
    resources/views/pages/services/uvdtf.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
--}}
@extends('layouts.theme')
@section('title', 'UV DTF Printing — Hard Surface Branding | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════ --}}
<section class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=1600&auto=format&fit=crop&q=80"
             alt="UV DTF Printing"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-24 sm:py-32">

        <nav class="flex items-center gap-1.5 text-xs text-white/40 mb-7">
            <a href="{{ url('/') }}" class="hover:text-white/70 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ url('/services') }}" class="hover:text-white/70 transition-colors">Services</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/60">UV DTF</span>
        </nav>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                     tracking-widest uppercase bg-fuchsia-600/20 border border-fuchsia-500/30 text-fuchsia-400 mb-5">
            ✦ Service 02
        </span>

        <h1 class="font-black text-white leading-[1.05] mb-5"
            style="font-size: clamp(2.2rem, 5vw, 4rem)">
            UV DTF Printing —<br>
            <span class="bg-gradient-to-r from-fuchsia-400 to-yellow-300 bg-clip-text text-transparent">
                Any Surface. Any Vision.
            </span>
        </h1>

        <p class="text-white/60 text-base leading-relaxed max-w-lg mb-8">
            Ultra-precise UV transfers that stick to virtually any hard surface — bottles, mugs,
            tumblers, phone cases, and more. Scratch-resistant, waterproof, and strikingly vivid.
        </p>

        <div class="flex flex-wrap gap-3">
            <a href="{{ url('/shop?category=uvdtf') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white
                      bg-fuchsia-600 hover:bg-fuchsia-700 transition-colors duration-150 shadow-lg">
                Order UV DTF Now
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
            @foreach(['Min. 1 Piece','24–72h Turnaround','Any Hard Surface','Scratch-Resistant','Waterproof','Free Digital Proof'] as $f)
            <div class="flex items-center gap-2 text-sm text-white/60">
                <svg class="w-4 h-4 text-fuchsia-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
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
     WHAT IS UV DTF?
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 sm:py-20 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-20 items-center">

            <div class="lg:w-[48%]">
                <div class="rounded-2xl overflow-hidden shadow-xl shadow-gray-200/50">
                    <img src="https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=800&auto=format&fit=crop&q=80"
                         alt="UV DTF on cups and bottles"
                         class="w-full object-cover" style="aspect-ratio: 4/3">
                </div>
            </div>

            <div class="flex-1">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-fuchsia-100 text-fuchsia-700 mb-4">
                    ✦ The Technology
                </span>
                <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-5 leading-snug">
                    What Exactly Is<br>
                    <span class="bg-gradient-to-r from-fuchsia-600 to-red-600 bg-clip-text text-transparent">
                        UV DTF Printing?
                    </span>
                </h2>
                <div class="space-y-3 text-gray-600 text-sm leading-relaxed mb-7">
                    <p>
                        UV DTF (UV Direct-to-Film) printing works by printing your full-colour design onto
                        a special transfer film using UV-cured inks. The film is then cold-peeled and
                        pressed onto the target surface — no heat press needed.
                    </p>
                    <p>
                        The UV-cured inks bond permanently to the surface, creating a slightly raised,
                        tactile finish that looks and feels premium. The result is scratch-resistant,
                        waterproof, and retains its vibrancy even with regular washing and handling.
                    </p>
                    <p>
                        Because it doesn't require heat, UV DTF works on surfaces that would warp or
                        melt — like plastic, acrylic, and even some electronics.
                        <strong class="text-gray-800">No limits on colour, no minimum order.</strong>
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['✅','Full colour + white underbase','Vivid even on dark surfaces'],
                        ['✅','Raised 3D texture','Premium tactile finish'],
                        ['✅','No heat required','Cold-peel process'],
                        ['✅','Dishwasher-safe','After 24h full cure'],
                    ] as [$icon,$title,$sub])
                    <div class="bg-fuchsia-50 border border-fuchsia-100 rounded-xl p-3">
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
            <p class="text-gray-500 text-sm">UV DTF works on virtually any smooth hard surface</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['🥤','Tumblers & Cups',  'Stainless, glass, plastic'],
                ['☕','Mugs',              'Ceramic, enamel, stainless'],
                ['📱','Phone Cases',       'Hard plastic & acrylic'],
                ['🍶','Bottles',           'Metal & glass varieties'],
                ['🪣','Lids & Buckets',   'Plastic surfaces'],
                ['💎','Acrylic Items',     'Keychains, signs & tags'],
            ] as [$emoji,$name,$sub])
            <div class="bg-white border border-gray-100 rounded-2xl p-4 text-center
                        hover:-translate-y-1 hover:shadow-md transition-all duration-200">
                <p class="text-3xl mb-2">{{ $emoji }}</p>
                <p class="font-bold text-gray-800 text-xs mb-0.5">{{ $name }}</p>
                <p class="text-gray-400 text-[10px]">{{ $sub }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     UV DTF vs OTHER METHODS
════════════════════════════════════════════════ --}}
<section class="bg-white py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-black text-gray-800 text-2xl sm:text-3xl mb-2">Why UV DTF Wins</h2>
            <p class="text-gray-500 text-sm">Compared to sublimation and standard vinyl stickers</p>
        </div>
        <div class="rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
            <table class="w-full text-sm bg-white min-w-[500px]">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left px-5 py-4 text-xs font-extrabold text-gray-400 uppercase tracking-widest">Feature</th>
                        <th class="px-4 py-4 text-center">
                            <span class="inline-block px-3 py-1 rounded-full bg-fuchsia-600 text-white text-[10px] font-extrabold">UV DTF</span>
                        </th>
                        <th class="px-4 py-4 text-center text-xs font-bold text-gray-400">Sublimation</th>
                        <th class="px-4 py-4 text-center text-xs font-bold text-gray-400">Vinyl Sticker</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach([
                        ['Works on dark surfaces', '✅ Yes',       '❌ No',        '✅ Yes'],
                        ['Raised 3D texture',      '✅ Yes',       '❌ Flat',      '❌ Flat'],
                        ['Scratch-resistant',       '✅ Yes',       '⚠️ Partial',  '❌ No'],
                        ['Dishwasher-safe',         '✅ After cure','✅ Yes',       '❌ No'],
                        ['Full photo-quality',      '✅ Yes',       '✅ Yes',       '⚠️ Limited'],
                        ['Min. order quantity',     '✅ 1 Piece',   '✅ 1 Piece',   '✅ 1 Piece'],
                    ] as [$feat,$uvdtf,$sub,$vinyl])
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5 text-xs font-semibold text-gray-600">{{ $feat }}</td>
                        <td class="px-4 py-3.5 text-center text-xs font-bold text-fuchsia-700 bg-fuchsia-50/40">{{ $uvdtf }}</td>
                        <td class="px-4 py-3.5 text-center text-xs text-gray-500">{{ $sub }}</td>
                        <td class="px-4 py-3.5 text-center text-xs text-gray-500">{{ $vinyl }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            <p class="text-gray-500 text-sm">Volume discounts applied automatically. Final price depends on surface area.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
            @foreach([
                ['1–9 pieces',   '₦3,500', false],
                ['10–49 pieces', '₦2,800', true],
                ['50+ pieces',   '₦2,200', false],
            ] as [$qty,$price,$popular])
            <div class="relative bg-white border rounded-2xl p-7 text-center
                        {{ $popular ? 'border-fuchsia-300 shadow-xl shadow-fuchsia-100/60' : 'border-gray-100' }}">
                @if($popular)
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full
                             bg-fuchsia-600 text-white text-[10px] font-extrabold whitespace-nowrap">
                    Best Value
                </span>
                @endif
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">{{ $qty }}</p>
                <p class="font-black text-gray-800 mb-1" style="font-size: 2.2rem">
                    {{ $price }}<span class="text-sm font-medium text-gray-400">/item</span>
                </p>
                <p class="text-xs text-gray-400">Standard transfer size</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-gray-400 mt-5">
            Prices based on standard sizes up to 10×10cm.
            <a href="{{ url('/contact') }}" class="text-fuchsia-600 hover:underline">Get a custom quote →</a>
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
            <p class="text-gray-500 text-sm">Four simple steps to branded merchandise</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['01','bg-fuchsia-600','Choose Your Item',    'Pick a tumbler, mug, bottle, or phone case from our catalog — or supply your own.'],
                ['02','bg-red-600',    'Upload Your Design',  'Send us your logo, artwork, or photo in PNG, PDF, or AI format.'],
                ['03','bg-yellow-500', 'Approve the Proof',   'We prepare a digital mock-up on your exact item and wait for your approval.'],
                ['04','bg-gray-800',   'Collect or Delivery', 'Ready in 24–72h. Collect from Lagos studio or we ship nationwide.'],
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
                ['🎁','Gift Giving',        'Personalised mugs, tumblers, and bottles make unforgettable birthday, anniversary, and graduation gifts.','fuchsia'],
                ['🏢','Corporate Branding', 'Brand company drinkware for conferences, corporate gifts, and staff welcome packs.','red'],
                ['🎉','Events & Parties',   'Custom cups and drinkware for weddings and parties — doubles as a memorable souvenir.','yellow'],
                ['📦','Product Packaging',  'Brand your product containers or bottles with your logo for a polished retail look.','fuchsia'],
                ['⚽','Sports & Teams',     'Branded bottles and tumblers for clubs, gyms, and athletic organisations.','red'],
                ['🛍️','Retail Merchandise', 'Add your brand to drinkware for your store — items customers will actually use daily.','yellow'],
            ] as [$emoji,$title,$body,$color])
            @php
            $ci = ['red'=>'bg-red-100','fuchsia'=>'bg-fuchsia-100','yellow'=>'bg-yellow-100'];
            @endphp
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
<section class="bg-gradient-to-r from-fuchsia-600 to-red-600 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-3xl mb-3">Ready to Brand Your Surfaces?</h2>
        <p class="text-white/75 text-sm mb-7">Min. 1 piece · Free proof · Waterproof result · Nigeria-wide delivery</p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ url('/shop?category=uvdtf') }}"
               class="inline-flex items-center gap-2 px-7 py-3 rounded-xl text-sm font-bold
                      text-fuchsia-700 bg-white hover:bg-gray-50 transition-colors">
                Order UV DTF Now
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