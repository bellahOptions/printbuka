@extends('layouts.theme')
@section('title', 'Welcome to PrintBuka')
@section('content')
    @php
/*
|─────────────────────────────────────────────────────────────────────────────
|  SLIDE DATA
|  Edit here. When you move to DB, delete this block and replace $slides with:
|  $slides = \App\Models\HeroSlide::active()->ordered()->get();
|─────────────────────────────────────────────────────────────────────────────
*/
$slides = [
    [
        'tag'                  => 'DTF T-Shirt Branding',
        'headline'             => 'Your Brand. <em>Worn with Pride.</em>',
        'subtext'              => 'Full-colour Direct-to-Film prints on t-shirts, hoodies & jerseys. Vibrant, wash-resistant, delivered fast. Min. 1 piece.',
        'audience'             => 'Teams, Churches, Events, Corporates',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Order T-Shirts',
        'cta_primary_url'      => '/shop?category=tshirts',
        'cta_secondary_label'  => 'See Samples',
        'cta_secondary_url'    => '/shop',
        'duration'             => 6,
    ],
    [
        'tag'                  => 'UV DTF — Hard Surface Printing',
        'headline'             => 'Any Surface. <em>Any Vision.</em>',
        'subtext'              => 'Scratch-resistant, waterproof UV DTF transfers on bottles, mugs, tumblers & phone cases. Colour so rich you can feel it.',
        'audience'             => 'Brands, Gift Buyers, Event Organisers',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Shop UV DTF Products',
        'cta_primary_url'      => '/shop?category=uvdtf',
        'cta_secondary_label'  => 'Get a Custom Quote',
        'cta_secondary_url'    => '/contact',
        'duration'             => 6,
    ],
    [
        'tag'                  => 'Laser Engraving',
        'headline'             => 'Precision <em>Cut into Forever.</em>',
        'subtext'              => 'Permanent elegance etched into wood, metal, leather, glass & acrylic — from executive plaques to pocket-sized keepsakes.',
        'audience'             => 'Corporates, Award Ceremonies, VIP Gifting',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Explore Engraving',
        'cta_primary_url'      => '/shop?category=laser',
        'cta_secondary_label'  => 'Upload Your Design',
        'cta_secondary_url'    => '/order/design',
        'duration'             => 6,
    ],
    [
        'tag'                  => 'Corporate & Executive Gifts',
        'headline'             => 'Impress the <em>People Who Matter.</em>',
        'subtext'              => 'Bespoke branded gifts that speak excellence — engraved trophies, premium pen sets, leather notebooks & custom gift boxes.',
        'audience'             => 'HR Teams, CEOs, Client Relations Managers',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Shop Corporate Gifts',
        'cta_primary_url'      => '/shop?category=corporate',
        'cta_secondary_label'  => 'Request Bulk Quote',
        'cta_secondary_url'    => '/contact',
        'duration'             => 6,
    ],
    [
        'tag'                  => 'Religious & Church Gifts',
        'headline'             => 'Honour the <em>Leaders Who Serve.</em>',
        'subtext'              => 'Dignified, heartfelt gifts for pastors, imams, priests & ministry leaders — engraved plaques, custom frames & branded church items.',
        'audience'             => 'Churches, Mosques, Faith Communities',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Shop Religious Gifts',
        'cta_primary_url'      => '/shop?category=religious',
        'cta_secondary_label'  => 'Use Gift Finder',
        'cta_secondary_url'    => '/gift-finder',
        'duration'             => 6,
    ],
    [
        'tag'                  => 'Personalized Gifts for Every Occasion',
        'headline'             => "A Gift They'll <em>Never Forget.</em>",
        'subtext'              => 'Birthdays, anniversaries, graduations & retirements — our catalog has a meaningful customized gift for every milestone in their life.',
        'audience'             => 'Individuals, Families, Couples, Friends',
        'bg'                   => 'https://unsplash.com/photos/purple-and-white-led-light-KshEaH06rV8',
        'cta_primary_label'    => 'Find the Perfect Gift',
        'cta_primary_url'      => '/gift-finder',
        'cta_secondary_label'  => 'Browse All Gifts',
        'cta_secondary_url'    => '/shop?category=gifts',
        'duration'             => 6,
    ],
];

$total    = count($slides);
$first    = $slides[0];
$duration = ($first['duration'] ?? 6) . 's';
@endphp

{{-- ─── Nothing below this line needs editing to change slide content ─── --}}



<section
  class="pb-body relative overflow-hidden bg-[#080C10]"
  style="height: clamp(520px, 92vh, 900px);"
  x-data="{ cur: 0, total: {{ $total }}, paused: false, _t: null,
    boot()  { this.start() },
    start() { this.stop(); if (!this.paused) this._t = setInterval(() => this.next(), {{ ($first['duration'] ?? 6) * 1000 }}) },
    stop()  { clearInterval(this._t); this._t = null },
    next()  { this.cur = (this.cur + 1) % this.total; this.resetBar(); this.start() },
    prev()  { this.cur = (this.cur - 1 + this.total) % this.total; this.resetBar(); this.start() },
    go(i)   { this.cur = i; this.resetBar(); this.start() },
    resetBar() { const b = this.$refs.bar; if (!b) return; b.style.animation='none'; b.offsetHeight; b.style.animation='' }
  }"
  x-init="boot()"
  @keydown.arrow-left.window="prev()"
  @keydown.arrow-right.window="next()"
  role="region"
  aria-label="PrintBuka featured services"
>

  {{-- ══════════════════════════════════════
       BACKGROUNDS  — rendered by Blade
  ══════════════════════════════════════ --}}
  @foreach($slides as $i => $slide)
    <div
      class="pb-slide pb-overlay absolute inset-0"
      :class="cur === {{ $i }} ? 'pb-slide-on' : 'pb-slide-off'"
      style="opacity: 0;"
      aria-hidden="true"
    >
      <div class="pb-bg absolute inset-0 bg-cover bg-center"
           style="background-image: url('{{ $slide['bg'] }}');"></div>
      <div class="pb-grain"></div>
    </div>
  @endforeach

  {{-- Left stripe --}}
  <div class="pb-stripe absolute left-0 top-0 bottom-0 w-0.75 z-30"></div>


  {{-- ══════════════════════════════════════
       CONTENT  — rendered by Blade
  ══════════════════════════════════════ --}}
  <div class="relative z-20 flex items-center h-full">
    <div class="w-full max-w-7xl mx-auto px-8 sm:px-12 lg:px-20">

      @foreach($slides as $i => $slide)
        <div
          x-show="cur === {{ $i }}"
          x-transition:enter="transition duration-300"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          class="max-w-2xl xl:max-w-3xl"
          x-cloak
        >

          {{-- Service badge --}}
          <div class="pr1 pb-tag inline-flex items-center gap-2.5 rounded-full px-4 py-1.5 mb-5 sm:mb-7">
            <span class="block w-1.5 h-1.5 rounded-full" style="background: var(--pb-fire);"></span>
            <span class="pb-body text-[11px] sm:text-xs font-semibold tracking-[.17em] uppercase text-white/80">
              {{ $slide['tag'] }}
            </span>
          </div>

          {{-- Headline --}}
          <h1 class="pb-display pr2 text-white font-bold leading-[1.07] mb-5 sm:mb-6"
              style="font-size: clamp(2.6rem, 5.8vw, 5.2rem);">
            {!! $slide['headline'] !!}
          </h1>

          {{-- Subtext --}}
          <p class="pr3 pb-body text-white/62 text-sm sm:text-base lg:text-lg leading-relaxed mb-4 max-w-lg">
            {{ $slide['subtext'] }}
          </p>

          {{-- Audience --}}
          @if(!empty($slide['audience']))
            <div class="pr4 flex items-center gap-2 mb-8 sm:mb-10">
              <svg class="w-3.5 h-3.5 shrink-0" style="color: var(--pb-fire);"
                   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                      clip-rule="evenodd"/>
              </svg>
              <span class="pb-body text-xs text-white/45 tracking-wide">
                Ideal for: {{ $slide['audience'] }}
              </span>
            </div>
          @endif

          {{-- CTAs --}}
          <div class="pr5 flex flex-wrap items-center gap-3 sm:gap-4">
            <a href="{{ $slide['cta_primary_url'] }}"
               class="pb-cta-p pb-body inline-flex items-center gap-2.5 px-8 py-3.5
                      text-white font-semibold text-sm sm:text-[15px]">
              {{ $slide['cta_primary_label'] }}
              <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                   fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
              </svg>
            </a>

            @if(!empty($slide['cta_secondary_label']))
              <a href="{{ $slide['cta_secondary_url'] }}"
                 class="pb-cta-g pb-body inline-flex items-center gap-2 rounded-sm px-7 py-3.5
                        text-white font-medium text-sm sm:text-[15px]">
                {{ $slide['cta_secondary_label'] }}
              </a>
            @endif
          </div>

        </div>
      @endforeach

    </div>
  </div>


  {{-- ══════════════════════════════════════
       TOP PROGRESS BAR
  ══════════════════════════════════════ --}}
  <div class="absolute top-0 left-0 right-0 h-0.5 z-40"
       style="background: rgba(255,255,255,.06);">
    <div class="pb-bar h-full" x-ref="bar"
         style="background: linear-gradient(to right, var(--pb-fire), var(--pb-ember));
                --pb-tick: {{ $duration }};"></div>
  </div>


  {{-- ══════════════════════════════════════
       SLIDE COUNTER  (top-right)
  ══════════════════════════════════════ --}}
  <div class="pb-body absolute top-5 right-7 sm:top-7 sm:right-10 z-40 flex items-baseline gap-1">
    <span class="pb-num-anim text-white font-bold text-xl tabular-nums"
          :key="cur"
          x-text="String(cur + 1).padStart(2, '0')"></span>
    <span class="text-white/22 text-xs mx-0.5">/</span>
    <span class="text-white/32 text-sm tabular-nums">{{ str_pad($total, 2, '0', STR_PAD_LEFT) }}</span>
  </div>


  {{-- ══════════════════════════════════════
       BOTTOM BAR — dots + label + arrows
  ══════════════════════════════════════ --}}
  <div class="absolute bottom-7 sm:bottom-9
              left-8 sm:left-12 lg:left-20
              right-8 sm:right-10 z-40
              flex items-center justify-between">

    {{-- Dot nav --}}
    <div class="flex items-center gap-2">
      @foreach($slides as $i => $slide)
        <button
          @click="go({{ $i }})"
          aria-label="Go to slide {{ $i + 1 }}: {{ $slide['tag'] }}"
          class="pb-dot transition-all duration-400"
          :class="cur === {{ $i }} ? 'pb-dot-active' : ''"
        ></button>
      @endforeach
    </div>

    {{-- Active tag label --}}
    <div class="hidden md:block overflow-hidden max-w-xs mx-4">
      @foreach($slides as $i => $slide)
        <p class="pb-body text-white/28 text-xs tracking-wider truncate"
           x-show="cur === {{ $i }}" x-cloak>
          {{ $slide['tag'] }}
        </p>
      @endforeach
    </div>

    {{-- Arrows --}}
    <div class="flex items-center gap-2">
      <button @click="prev()" aria-label="Previous slide"
              class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-white/20
                     flex items-center justify-center text-white
                     hover:border-white/50 hover:bg-white/10 transition-all duration-200 active:scale-90">
        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>
      <button @click="next()" aria-label="Next slide"
              class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-white
                     transition-all duration-200 active:scale-90 hover:brightness-110"
              style="background: var(--pb-fire);">
        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>
    </div>

  </div>

  {{-- Hover pause --}}
  <div class="absolute inset-0 z-10"
       @mouseenter="paused = true; stop()"
       @mouseleave="paused = false; start()"></div>

</section>

<section class="py-26 px-8 sm:px-12 lg:px-20 bg-white/95">
    <h3 class="text-center text-xl bg-cyan-100 text-cyan-800 mb-4 w-50 flex justify-center place-self-center align-center rounded-lg p-2">What we do</h3>
    <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-8">Your One-Stop Corporate Print & Custom Gift Hub</h1>
    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">From vibrant DTF apparel to elegant laser-engraved keepsakes, we offer a wide range of customizable products perfect for corporate branding, employee recognition, and memorable client gifts. Explore our services and find the perfect solution for your business needs.</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
       <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">T-Shirt(DTF) Printing</h2>
            <p class="card-description text-gray-600 mt-2">Full-colour, high-definition prints on any fabric. Our Direct-to-Film (DTF) technology delivers vibrant, wash-resistant designs that last. Perfect for corporate uniforms, team jerseys, events, and personal fashion.</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
        </div> 
        </div>
        <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">UV DTF Printing</h2>
            <p class="card-description text-gray-600 mt-2">Full-colour, Ultra-precise UV DTF transfers for hard surfaces — bottles, phone cases, mugs, tumblers, and more. Produces rich, textured prints that are scratch-resistant and waterproof..</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
        </div>
       </div>
       <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">Laser Engraving</h2>
            <p class="card-description text-gray-600 mt-2">FPermanent, elegant personalization etched directly into wood, metal, glass, leather, acrylic, and more. Ideal for executive gifts, trophies, plaques, keychains, and personalized keepsakes.</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
        </div>
        </div>
        <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">Direct Image Printing</h2>
            <p class="card-description text-gray-600 mt-2">High-resolution direct-to-substrate printing for rigid and flexible surfaces. Great for signage, canvases, custom boards, display items, and photo gifts..</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
            </div>
        </div>
        <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">Customizable Gift Items</h2>
            <p class="card-description text-gray-600 mt-2">Explore our curated catalog of over 200 giftable items — mugs, keychains, caps, tote bags, notebooks, frames, plaques, and more — all customizable with your message, logo, or artwork.</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
            </div>
        </div>
        <div class="flex flex-col items-center border border-gray-50 rounded-lg  bg-white">
        <img class="card-image mb-4 rounded-t-2xl" src="https://placehold.co/500x280" alt="DTF Printing">
        <div class="card-content p-2 py-5 pb-10 rounded-lg">
            <h2 class="card-title text-3xl font-semibold text-gray-800">Bulk & Corporate Printing</h2>
            <p class="card-description text-gray-600 mt-2">Need large volumes? We handle bulk orders through our parent brand, Alet Inspirationz Prints Limited — including offset printing, promotional materials, corporate stationery, and branded packaging.</p>
            <a class="card-link flex items-center space-x-5 mt-4 bg-pink-600 text-white p-2 rounded-lg font-medium" href="/shop?category=tshirts">Explore DTF Printing 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
</svg>
            </a>
        </div>
        </div>
    </div>
</section>

{{-- Why PrintBuka --}}
<section class="py-26 px-8 sm:px-12 lg:px-20 bg-white/95"> 
  <div class="grid grid-cols-2">
    <div class="sect-title">
      <h1 class="text-9xl">Why Choose <span class="text-pink-600">PrintBuka</span>?</h1>
    </div>  
    <div class="why-grid flex">
      <div class="why-card flex flex-col items-center text-center p-5 m-2 bg-cyan-50 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-22 my-3 text-cyan-600" fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
  <path d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.73 1.73 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.73 1.73 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.73 1.73 0 0 0 3.407 2.31zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"/>
</svg>
        <h2 class="text-xl text-cyan-600 font-semibold mb-2">Unmatched Quality</h2>
        <p class="text-cyan-600">We use state-of-the-art printing and engraving technology to ensure every product meets the highest standards of quality and durability.</p>
      </div>
      <div class="why-card flex flex-col items-center text-center p-5 m-2 bg-yellow-50 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-22 my-3 text-yellow-600" width="16" height="16" fill="currentColor" class="bi bi-palette" viewBox="0 0 16 16">
  <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8m-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7"/>
</svg>
        <h2 class="text-xl text-yellow-600 font-semibold mb-2">Endless Customization</h2>
        <p class="text-yellow-600">From vibrant DTF prints to elegant laser engravings, we offer a wide range of customizable products to suit every occasion and brand identity.</p>
      </div>
      <div class="why-card flex flex-col items-center text-center p-5 m-2 bg-pink-50 rounded-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-22 my-3 text-pink-600" width="16" height="16" fill="currentColor" class="bi bi-chat-square-quote" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M7.066 4.76A1.665 1.665 0 0 0 4 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
</svg>
        <h2 class="text-xl text-pink-600 font-semibold mb-2">Exceptional Customer Service</h2>
        <p class="text-pink-600">Our dedicated support team is here to assist you at every step, ensuring a seamless ordering process and complete satisfaction with your purchase.</p>
    </div>
  </div>

  </div>
</section>
@endsection