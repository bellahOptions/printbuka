{{--
    resources/views/pages/home.blade.php
    Pure Tailwind CSS · No inline styles
    Ecommerce-style print shop homepage · DM Sans font
--}}
@extends('layouts.theme')
@section('title', 'PrintBuka — Custom Printing & Corporate Gift Solutions in Nigeria')
@section('content')

{{-- ════════════════════════════════════════════════
     HERO SLIDESHOW
════════════════════════════════════════════════ --}}
@php
$slides = [
    [
        'tag'     => 'DTF T-Shirt Branding',
        'h1'      => 'Your Brand,',
        'h2'      => 'Worn with Pride.',
        'sub'     => 'Full-colour Direct-to-Film prints on t-shirts, hoodies & jerseys. Vibrant, wash-resistant, fast. Min. 1 piece.',
        'badge'   => 'For: Teams · Churches · Events · Corporates',
        'bg'      => 'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=1600&auto=format&fit=crop&q=80',
        'btn_cls' => 'bg-pink-600 hover:bg-pink-700',
        'dot_cls' => 'bg-pink-500',
        'cta1'    => 'Order T-Shirts',     'url1' => '/shop?category=tshirts',
        'cta2'    => 'See Samples',        'url2' => '/shop',
    ],
    [
        'tag'     => 'UV DTF — Hard Surfaces',
        'h1'      => 'Any Surface.',
        'h2'      => 'Any Vision.',
        'sub'     => 'Scratch-resistant, waterproof UV DTF transfers on bottles, mugs, tumblers & phone cases. Colour so rich you can feel it.',
        'badge'   => 'For: Brands · Gift Buyers · Event Organisers',
        'bg'      => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=1600&auto=format&fit=crop&q=80',
        'btn_cls' => 'bg-pink-950 hover:bg-pink-950',
        'dot_cls' => 'bg-pink-950',
        'cta1'    => 'Shop UV DTF',         'url1' => '/shop?category=uvdtf',
        'cta2'    => 'Get a Custom Quote',  'url2' => '/contact',
    ],
    [
        'tag'     => 'Laser Engraving',
        'h1'      => 'Precision',
        'h2'      => 'Cut into Forever.',
        'sub'     => 'Permanent elegance etched into wood, metal, leather, glass & acrylic. Ideal for trophies, plaques, keychains, and executive gifts.',
        'badge'   => 'For: Corporates · Ceremonies · VIP Gifting',
        'bg'      => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600&auto=format&fit=crop&q=80',
        'btn_cls' => 'bg-yellow-500 hover:bg-yellow-600',
        'dot_cls' => 'bg-yellow-400',
        'cta1'    => 'Explore Engraving',   'url1' => '/shop?category=laser',
        'cta2'    => 'Upload Your Design',  'url2' => '/order/design',
    ],
    [
        'tag'     => 'Corporate Gifts',
        'h1'      => 'Impress the',
        'h2'      => 'People Who Matter.',
        'sub'     => 'Bespoke branded gifts that speak excellence — engraved trophies, premium pen sets, leather notebooks & custom gift boxes.',
        'badge'   => 'For: HR Teams · CEOs · Client Relations',
        'bg'      => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=1600&auto=format&fit=crop&q=80',
        'btn_cls' => 'bg-pink-600 hover:bg-pink-700',
        'dot_cls' => 'bg-pink-500',
        'cta1'    => 'Shop Corporate Gifts', 'url1' => '/shop?category=corporate',
        'cta2'    => 'Request Bulk Quote',   'url2' => '/contact',
    ],
    [
        'tag'     => 'Personalized Gifts',
        'h1'      => "A Gift They'll",
        'h2'      => 'Never Forget.',
        'sub'     => 'Birthdays, anniversaries, graduations & retirements — our catalog has a meaningful customized gift for every milestone.',
        'badge'   => 'For: Individuals · Families · Couples',
        'bg'      => 'https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=1600&auto=format&fit=crop&q=80',
        'btn_cls' => 'bg-pink-950 hover:bg-pink-950',
        'dot_cls' => 'bg-pink-950',
        'cta1'    => 'Find the Perfect Gift', 'url1' => '/gift-finder',
        'cta2'    => 'Browse All Gifts',      'url2' => '/shop?category=gifts',
    ],
];
$total = count($slides);
@endphp

<section
    class="relative overflow-hidden bg-gray-900"
    style="height: clamp(520px, 88vh, 860px)"
    x-data="{
        cur: 0,
        paused: false,
        _t: null,
        boot(){ this.tick() },
        tick(){ this.stop(); if(!this.paused) this._t = setInterval(()=>this.next(), 6500) },
        stop(){ clearInterval(this._t) },
        next(){ this.cur = (this.cur + 1) % {{ $total }}; this.resetBar(); this.tick() },
        prev(){ this.cur = (this.cur - 1 + {{ $total }}) % {{ $total }}; this.resetBar(); this.tick() },
        go(i){ this.cur = i; this.resetBar(); this.tick() },
        resetBar(){
            const b = this.$refs.progressBar;
            if(!b) return;
            b.style.animation = 'none';
            b.offsetHeight;
            b.style.animation = '';
        }
    }"
    x-init="boot()"
    @keydown.arrow-left.window="prev()"
    @keydown.arrow-right.window="next()"
    @mouseenter="paused=true; stop()"
    @mouseleave="paused=false; tick()"
    role="region"
    aria-label="Featupink services slideshow">

    {{-- ── Slide backgrounds ── --}}
    @foreach($slides as $i => $slide)
    <div class="absolute inset-0 transition-opacity duration-1000"
         :class="cur === {{ $i }} ? 'opacity-100 z-10' : 'opacity-0 z-0'"
         aria-hidden="true">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[8000ms]"
             :class="cur === {{ $i }} ? 'scale-[1.06]' : 'scale-100'"
             style="background-image: url('{{ $slide['bg'] }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/10"></div>
        <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-black/65 to-transparent"></div>
    </div>
    @endforeach

    {{-- ── Progress bar ── --}}
    <div class="absolute top-0 inset-x-0 h-1 z-30 bg-white/10">
        <div x-ref="progressBar"
             class="h-full"
             style="animation: heroProgress 6.5s linear forwards">
            @foreach($slides as $i => $slide)
            <div class="absolute inset-0 {{ $slide['dot_cls'] }} transition-opacity duration-500"
                 :class="cur === {{ $i }} ? 'opacity-100' : 'opacity-0'"></div>
            @endforeach
        </div>
    </div>

    {{-- ── Slide counter ── --}}
    <div class="absolute top-5 right-6 sm:top-7 sm:right-10 z-30 flex items-baseline gap-1 text-white select-none">
        <span class="font-black text-2xl tabular-nums" x-text="String(cur + 1).padStart(2, '0')"></span>
        <span class="text-white/30 text-sm">/{{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- ── Content ── --}}
    <div class="relative z-20 flex items-center h-full">
        <div class="w-full max-w-7xl mx-auto px-8 sm:px-12 lg:px-20">

            @foreach($slides as $i => $slide)
            <div x-show="cur === {{ $i }}"
                 x-transition:enter="transition ease-out duration-500 delay-150"
                 x-transition:enter-start="opacity-0 translate-y-5"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="max-w-2xl xl:max-w-3xl"
                 x-cloak>

                <div class="flex items-center gap-2 mb-5">
                    <span class="w-2 h-2 rounded-full {{ $slide['dot_cls'] }}"></span>
                    <span class="text-xs font-bold tracking-widest uppercase text-white/70">{{ $slide['tag'] }}</span>
                </div>

                <h1 class="font-black text-white leading-[1.05] mb-5"
                    style="font-size: clamp(2.4rem, 6vw, 5rem)">
                    {{ $slide['h1'] }}<br>
                    <span class="bg-pink-600 bg-clip-text text-transparent">
                        {{ $slide['h2'] }}
                    </span>
                </h1>

                <p class="text-white/70 text-sm sm:text-base leading-relaxed mb-3 max-w-lg">
                    {{ $slide['sub'] }}
                </p>
                <p class="text-white/35 text-xs mb-8 tracking-wide">{{ $slide['badge'] }}</p>

                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                    <a href="{{ $slide['url1'] }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white
                              transition-all duration-200 shadow-lg hover:-translate-y-0.5 {{ $slide['btn_cls'] }}">
                        {{ $slide['cta1'] }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ $slide['url2'] }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white
                              border border-white/30 hover:bg-white/10 hover:border-white/60 transition-all duration-200">
                        {{ $slide['cta2'] }}
                    </a>
                </div>

            </div>
            @endforeach

        </div>
    </div>

    {{-- ── Bottom controls ── --}}
    <div class="absolute inset-x-0 bottom-7 z-30 max-w-7xl mx-auto px-8 sm:px-12 lg:px-20
                flex items-center justify-between">

        {{-- Dots --}}
        <div class="flex items-center gap-2">
            @foreach($slides as $i => $slide)
            <button @click="go({{ $i }})"
                    aria-label="Slide {{ $i + 1 }}"
                    class="h-1.5 rounded-full transition-all duration-300 {{ $slide['dot_cls'] }}"
                    :class="cur === {{ $i }} ? 'w-6 opacity-100' : 'w-1.5 opacity-30 bg-white'">
            </button>
            @endforeach
        </div>

        {{-- Arrows --}}
        <div class="flex items-center gap-2">
            <button @click="prev()" aria-label="Previous"
                    class="w-9 h-9 rounded-full border border-white/30 flex items-center justify-center
                           text-white hover:bg-white/15 hover:border-white/60 transition-all duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next()" aria-label="Next"
                    class="w-9 h-9 rounded-full flex items-center justify-center text-white
                           bg-pink-600 hover:opacity-90 transition-opacity duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>

</section>

{{-- Hero progress animation --}}
<style>
    @keyframes heroProgress { from { width: 0% } to { width: 100% } }
    [x-ref="progressBar"] { animation: heroProgress 6.5s linear forwards; }
</style>


{{-- ════════════════════════════════════════════════
     TRUST BAR
════════════════════════════════════════════════ --}}
<div class="bg-gray-900 border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 py-3
                flex flex-wrap items-center justify-center gap-x-8 gap-y-2">
        @foreach([
            '🚚 Nigeria-Wide Delivery',
            '⚡ 24–72h Turnaround',
            '1️⃣ Min. 1 Piece',
            '✅ Proof Before Print',
            '📞 Dedicated Support',
        ] as $t)
        <span class="text-xs font-medium text-gray-400 whitespace-nowrap">{{ $t }}</span>
        @endforeach
    </div>
</div>


{{-- ════════════════════════════════════════════════
     SHOP BY CATEGORY
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-14 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">
        <h2 class="font-black text-gray-800 text-2xl sm:text-3xl text-center mb-8">Shop by Category</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach([
                ['👕', 'T-Shirts',    '/shop?category=tshirts',   'from-pink-50 to-pink-100 hover:from-pink-100 hover:to-pink-200',           'text-pink-600'],
                ['🖨️', 'UV DTF',      '/shop?category=uvdtf',     'from-fuchsia-50 to-fuchsia-100 hover:from-fuchsia-100 hover:to-fuchsia-200', 'text-pink-950'],
                ['✍️', 'Engraving',   '/shop?category=laser',     'from-yellow-50 to-yellow-100 hover:from-yellow-100 hover:to-yellow-200', 'text-yellow-700'],
                ['🎁', 'Gifts',       '/shop?category=gifts',     'from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200', 'text-orange-600'],
                ['🏢', 'Corporate',   '/shop?category=corporate', 'from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300',   'text-slate-700'],
                ['📦', 'Bulk Orders', '/bulk-orders',             'from-green-50 to-green-100 hover:from-green-100 hover:to-green-200',    'text-green-700'],
            ] as [$emoji, $label, $href, $gradient, $color])
            <a href="{{ url($href) }}"
               class="group flex flex-col items-center justify-center gap-2.5 py-6 px-4 rounded-2xl
                      bg-gradient-to-br {{ $gradient }} border border-white/80
                      hover:-translate-y-1 hover:shadow-md transition-all duration-200 text-center">
                <span class="text-3xl">{{ $emoji }}</span>
                <span class="text-xs font-bold {{ $color }}">{{ $label }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     WHAT WE DO — SERVICE CARDS
════════════════════════════════════════════════ --}}
<section class="bg-white py-20 sm:py-28 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        {{-- Section header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-12 sm:mb-16">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-gradient-to-r from-pink-100 to-fuchsia-100
                             text-pink-950 mb-3">
                    ✦ What We Do
                </span>
                <h2 class="font-black text-gray-800 leading-tight"
                    style="font-size: clamp(1.9rem, 4vw, 3rem)">
                    Your One-Stop Print &amp;<br>
                    <span class="bg-pink-600 bg-clip-text text-transparent">
                        Custom Gift Hub
                    </span>
                </h2>
            </div>
            <p class="text-gray-500 text-sm leading-relaxed max-w-sm sm:text-right">
                From vibrant DTF apparel to laser-engraved keepsakes — every product perfectly
                customised for your brand, people, and moments.
            </p>
        </div>

        {{-- Cards grid --}}
        @php
        $services = [
            [
                'num'   => '01',
                'color' => 'pink',
                'icon'  => 'M6.5 3.5L3 7l3 2v10h12V9l3-2-3.5-3.5L15 5.5a3 3 0 01-6 0z',
                'title' => 'T-Shirt DTF Printing',
                'desc'  => 'Full-colour, high-definition prints on any fabric. Vibrant, wash-resistant designs perfect for corporate uniforms, team jerseys, events, and personal fashion.',
                'link'  => '/shop?category=tshirts',
                'label' => 'Explore DTF Printing',
            ],
            [
                'num'   => '02',
                'color' => 'fuchsia',
                'icon'  => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                'title' => 'UV DTF Printing',
                'desc'  => 'Ultra-precise UV transfers for hard surfaces — bottles, mugs, tumblers & phone cases. Rich, textupink prints that are scratch-resistant and waterproof.',
                'link'  => '/shop?category=uvdtf',
                'label' => 'Explore UV DTF',
            ],
            [
                'num'   => '03',
                'color' => 'yellow',
                'icon'  => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                'title' => 'Laser Engraving',
                'desc'  => 'Permanent, elegant personalization etched into wood, metal, glass, leather, and acrylic. Ideal for trophies, plaques, keychains, and executive gifts.',
                'link'  => '/shop?category=laser',
                'label' => 'Explore Engraving',
            ],
            [
                'num'   => '04',
                'color' => 'pink',
                'icon'  => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                'title' => 'Direct Image Printing',
                'desc'  => 'High-resolution direct-to-substrate printing for rigid and flexible surfaces. Great for signage, canvases, display items, and photo gifts.',
                'link'  => '/shop?category=direct-image',
                'label' => 'Explore Direct Image',
            ],
            [
                'num'   => '05',
                'color' => 'fuchsia',
                'icon'  => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7',
                'title' => 'Customizable Gift Items',
                'desc'  => 'Over 200 giftable items — mugs, keychains, caps, tote bags, notebooks, frames, plaques — all personalised with your message, logo, or artwork.',
                'link'  => '/shop?category=gifts',
                'label' => 'Browse Gift Items',
            ],
        ];

        $cm = [
            'pink' => [
                'icon_bg'   => 'bg-pink-50',
                'icon_text' => 'text-pink-600',
                'icon_hov'  => 'group-hover:bg-pink-100',
                'border'    => 'group-hover:border-t-pink-500',
                'link'      => 'text-pink-600 hover:text-pink-700',
                'num'       => 'text-pink-100',
            ],
            'fuchsia' => [
                'icon_bg'   => 'bg-fuchsia-50',
                'icon_text' => 'text-pink-950',
                'icon_hov'  => 'group-hover:bg-fuchsia-100',
                'border'    => 'group-hover:border-t-pink-950',
                'link'      => 'text-pink-950 hover:text-pink-950',
                'num'       => 'text-fuchsia-100',
            ],
            'yellow' => [
                'icon_bg'   => 'bg-yellow-50',
                'icon_text' => 'text-yellow-600',
                'icon_hov'  => 'group-hover:bg-yellow-100',
                'border'    => 'group-hover:border-t-yellow-500',
                'link'      => 'text-yellow-600 hover:text-yellow-700',
                'num'       => 'text-yellow-100',
            ],
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @foreach($services as $s)
            @php $c = $cm[$s['color']]; @endphp
            <div class="group bg-white border border-gray-100 border-t-2 border-t-gray-100 rounded-2xl p-6
                        flex flex-col hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-200/60
                        {{ $c['border'] }} transition-all duration-300">

                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-xl {{ $c['icon_bg'] }} {{ $c['icon_text'] }} {{ $c['icon_hov'] }}
                                flex items-center justify-center transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="font-black text-4xl leading-none select-none {{ $c['num'] }}">{{ $s['num'] }}</span>
                </div>

                <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $s['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5 flex-1">{{ $s['desc'] }}</p>

                <a href="{{ url($s['link']) }}"
                   class="inline-flex items-center gap-1.5 text-xs font-bold {{ $c['link'] }} transition-colors duration-150">
                    {{ $s['label'] }}
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1"
                         fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                    </svg>
                </a>
            </div>
            @endforeach

            {{-- Bulk & Corporate — dark featupink card --}}
            <div class="group bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-7 flex flex-col
                        hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300
                        sm:col-span-2 lg:col-span-1">
                <div class="flex items-start justify-between mb-5">
                    <div class="w-12 h-12 rounded-xl bg-white/10 text-white flex items-center justify-center
                                group-hover:bg-white/15 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-black text-4xl leading-none select-none text-white/10">06</span>
                </div>
                <h3 class="font-bold text-white text-lg mb-2">Bulk &amp; Corporate Printing</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-1">
                    Need large volumes? We handle bulk orders through our parent brand,
                    <strong class="text-white">Alet Inspirationz Prints Limited</strong> — offset printing,
                    corporate stationery, promotional materials, and branded packaging.
                </p>
                <div class="flex flex-wrap gap-3 items-center">
                    <a href="{{ url('/bulk-orders') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-gray-900
                              bg-gradient-to-r from-yellow-400 to-yellow-300
                              hover:-translate-y-0.5 hover:shadow-lg hover:shadow-yellow-500/30 transition-all duration-200">
                        Request Bulk Quote
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                        </svg>
                    </a>
                    <a href="{{ url('/contact') }}"
                       class="text-sm font-semibold text-gray-500 hover:text-white transition-colors duration-150">
                        Talk to us →
                    </a>
                </div>
            </div>

        </div>

        {{-- Stats bar --}}
        <div class="mt-10 rounded-2xl border border-gray-100 overflow-hidden grid grid-cols-2 sm:grid-cols-4">
            @foreach([
                ['200+',   'Products',     'text-pink-600'],
                ['24–72h', 'Turnaround',   'text-pink-950'],
                ['4',      'Technologies', 'text-yellow-500'],
                ['1 Piece','Min. Order',   'text-gray-800'],
            ] as [$v, $l, $c])
            <div class="flex flex-col items-center justify-center py-6 px-4 bg-white
                        border-r border-b sm:border-b-0 border-gray-100 last:border-r-0 text-center">
                <span class="font-black text-2xl {{ $c }}">{{ $v }}</span>
                <span class="text-gray-400 text-xs mt-1">{{ $l }}</span>
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════════
     WHY PRINTBUKA
════════════════════════════════════════════════ --}}
<section class="bg-gray-50 py-20 sm:py-28 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col lg:flex-row gap-14 xl:gap-24">

            {{-- Left sticky panel --}}
            <div class="lg:w-[38%] lg:sticky lg:top-24 lg:self-start">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-gradient-to-r from-yellow-100 to-fuchsia-100
                             text-pink-950 mb-4">
                    ✦ Why PrintBuka
                </span>
                <h2 class="font-black text-gray-800 leading-tight mb-5"
                    style="font-size: clamp(1.9rem, 4vw, 3rem)">
                    We Don't Just<br>Print. We Make<br>
                    <span class="bg-gradient-to-r from-pink-600 to-pink-950 bg-clip-text text-transparent">
                        Things Matter.
                    </span>
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
                    Too many print shops promise quality and deliver frustration.
                    We built PrintBuka on a different standard — where every order is treated
                    like it matters, because to you, it does.
                </p>
                <div class="flex flex-wrap gap-3 mb-7">
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white
                              bg-pink-600
                              hover:opacity-90 hover:-translate-y-0.5 transition-all duration-200 shadow-sm shadow-pink-200">
                        Start Your Order
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ url('/about') }}"
                       class="text-sm font-semibold text-gray-500 hover:text-gray-800 transition-colors duration-150
                              flex items-center gap-1">
                        Our Story →
                    </a>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach(['🚚 Nigeria-Wide', '⚡ 24–72h Fast', '1️⃣ Min. 1 Piece', '✅ Proof First'] as $b)
                    <span class="text-xs font-semibold text-gray-600 border border-gray-200 rounded-full px-3 py-1.5">
                        {{ $b }}
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Right reasons grid --}}
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-x-8">
                @php
                $reasons = [
                    ['icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                     'num'=>'01','bg'=>'bg-pink-50','text'=>'text-pink-600',
                     'title'=>'Premium Quality','body'=>'Industry-leading equipment on every job. What you approve in the proof is exactly what you receive.'],
                    ['icon'=>'M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5',
                     'num'=>'02','bg'=>'bg-fuchsia-50','text'=>'text-pink-950',
                     'title'=>'Order Online, Easily','body'=>'Upload your design, pick your product, pay — all from your phone. No back-and-forth emails to get started.'],
                    ['icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                     'num'=>'03','bg'=>'bg-yellow-50','text'=>'text-yellow-600',
                     'title'=>'Real-Time Tracking','body'=>'Monitor every stage — design approval through production to delivery — right from your dashboard.'],
                    ['icon'=>'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7',
                     'num'=>'04','bg'=>'bg-pink-50','text'=>'text-pink-600',
                     'title'=>'Expert Gift Curation','body'=>'Our Smart Gift Finder suggests the perfect custom item based on recipient, occasion, and budget.'],
                    ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z',
                     'num'=>'05','bg'=>'bg-fuchsia-50','text'=>'text-pink-950',
                     'title'=>'Fast Turnaround','body'=>'Most standard orders completed within 24–72 hours of design approval. Rush options available.'],
                    ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                     'num'=>'06','bg'=>'bg-yellow-50','text'=>'text-yellow-600',
                     'title'=>'Proven Heritage','body'=>'Powepink by Alet Inspirationz Prints Limited — years of commercial print production behind every order.'],
                ];
                @endphp

                @foreach($reasons as $r)
                <div class="group border-l-2 border-gray-200 hover:border-pink-500 pl-5 py-5
                            border-b border-b-gray-100 last:border-b-0 transition-all duration-200">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl {{ $r['bg'] }} {{ $r['text'] }} flex items-center justify-center
                                    shrink-0 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $r['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-extrabold {{ $r['text'] }} opacity-50 mb-1">{{ $r['num'] }}</p>
                            <h3 class="font-bold text-gray-800 text-base mb-1.5">{{ $r['title'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $r['body'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════
     CTA BANNER
════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-pink-600 via-pink-950 to-pink-950 py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="font-black text-white text-2xl sm:text-4xl mb-4 leading-tight">
            Ready to Print Something Amazing?
        </h2>
        <p class="text-white/80 text-sm sm:text-base mb-8 max-w-xl mx-auto leading-relaxed">
            Place your first order today and experience the PrintBuka difference.
            Fast turnaround, unmatched quality, and support every step of the way.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('shop') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold
                      text-pink-950 bg-white hover:bg-gray-50 hover:-translate-y-0.5
                      hover:shadow-lg transition-all duration-200">
                Start Shopping
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ url('/contact') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-bold
                      text-white border-2 border-white/40 hover:bg-white/10 hover:border-white/70
                      transition-all duration-200">
                Talk to Us
            </a>
        </div>
    </div>
</section>

@endsection