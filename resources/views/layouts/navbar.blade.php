{{--
    resources/views/layouts/navbar.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
    Dynamic @guest / @auth · Alpine.js v3 required
--}}

<header class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm">

    {{-- Brand accent stripe --}}
    <div class="h-1 bg-gradient-to-r from-red-600 via-red-950 to-yellow-400"></div>

    <nav class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10"
         x-data="{ open: false, shopOpen: false }">

        <div class="flex items-center justify-between h-16">

            {{-- ── Logo ── --}}
            <a href="{{ url('/') }}" class="shrink-0">
                <img src="{{ asset('logo.svg') }}" alt="PrintBuka" class="h-8 w-auto">
            </a>

            {{-- ════════════════════════════
                 DESKTOP NAV LINKS
            ════════════════════════════ --}}
            <div class="hidden lg:flex items-center gap-7">

                <a href="{{ url('/') }}"
                   class="text-sm font-medium transition-colors duration-150
                          {{ request()->is('/') ? 'text-red-600 border-b-2 border-red-500 pb-0.5' : 'text-gray-700 hover:text-red-600' }}">
                    Home
                </a>

                {{-- Shop mega-menu (CSS group hover) --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 text-sm font-medium text-gray-700
                                   group-hover:text-red-600 transition-colors duration-150
                                   bg-transparent border-0 p-0 cursor-pointer">
                        Shop
                        <svg class="w-3.5 h-3.5 mt-0.5 transition-transform duration-200 group-hover:rotate-180"
                             fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Mega panel --}}
                    <div class="absolute top-full left-1/2 -translate-x-1/2 mt-3
                                w-[860px] max-w-[94vw] bg-white rounded-2xl
                                border border-gray-100 shadow-2xl shadow-gray-200/50
                                opacity-0 invisible -translate-y-2 pointer-events-none
                                group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto
                                transition-all duration-200">

                        <div class="h-0.5 rounded-t-2xl bg-gradient-to-r from-red-600 via-red-950 to-yellow-400"></div>

                        <div class="p-6 grid grid-cols-4 gap-5">

                            <div>
                                <p class="text-[10px] font-extrabold tracking-widest uppercase text-red-500 mb-3">Apparel Branding</p>
                                @foreach([
                                    ['DTF T-Shirts',     '/shop/dtf-tshirts'],
                                    ['UV DTF Prints',    '/shop/uvdtf'],
                                    ['Custom Hoodies',   '/shop/hoodies'],
                                    ['Uniform Branding', '/shop/uniforms'],
                                ] as [$label, $href])
                                <a href="{{ url($href) }}"
                                   class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm text-gray-600
                                          font-medium hover:bg-red-50 hover:text-red-600 hover:pl-3.5
                                          transition-all duration-150">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 shrink-0"></span>
                                    {{ $label }}
                                </a>
                                @endforeach
                            </div>

                            <div>
                                <p class="text-[10px] font-extrabold tracking-widest uppercase text-red-950 mb-3">Custom Gifts</p>
                                @foreach([
                                    ['Custom Mugs',     '/shop/mugs'],
                                    ['Gift Boxes',      '/shop/gift-boxes'],
                                    ['Photo Frames',    '/shop/frames'],
                                    ['Branded Bottles', '/shop/bottles'],
                                ] as [$label, $href])
                                <a href="{{ url($href) }}"
                                   class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm text-gray-600
                                          font-medium hover:bg-fuchsia-50 hover:text-red-950 hover:pl-3.5
                                          transition-all duration-150">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-950 shrink-0"></span>
                                    {{ $label }}
                                </a>
                                @endforeach
                            </div>

                            <div>
                                <p class="text-[10px] font-extrabold tracking-widest uppercase text-yellow-600 mb-3">Laser Engraving</p>
                                @foreach([
                                    ['Engraved Pens',   '/shop/engraved-pens'],
                                    ['Wooden Gifts',    '/shop/wooden-gifts'],
                                    ['Acrylic Awards',  '/shop/acrylic-awards'],
                                    ['Name Plates',     '/shop/nameplates'],
                                ] as [$label, $href])
                                <a href="{{ url($href) }}"
                                   class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm text-gray-600
                                          font-medium hover:bg-yellow-50 hover:text-yellow-700 hover:pl-3.5
                                          transition-all duration-150">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 shrink-0"></span>
                                    {{ $label }}
                                </a>
                                @endforeach
                            </div>

                            <div class="border-l border-gray-100 pl-5">
                                <p class="text-[10px] font-extrabold tracking-widest uppercase text-gray-400 mb-3">Corporate & Bulk</p>
                                @foreach([
                                    ['Offset Printing',  '/shop/offset'],
                                    ['Business Cards',   '/shop/business-cards'],
                                    ['Brochures',        '/shop/brochures'],
                                    ['Packaging',        '/shop/packaging'],
                                ] as [$label, $href])
                                <a href="{{ url($href) }}"
                                   class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm text-gray-600
                                          font-medium hover:bg-gray-50 hover:text-gray-800 hover:pl-3.5
                                          transition-all duration-150">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 shrink-0"></span>
                                    {{ $label }}
                                </a>
                                @endforeach

                                <div class="mt-4 bg-gradient-to-br from-orange-50 to-pink-50 border border-pink-100 rounded-xl p-3.5">
                                    <p class="text-sm font-bold text-gray-800 mb-1">🎁 Gift Finder</p>
                                    <p class="text-xs text-gray-500 leading-relaxed mb-2">Not sure what to order? Get a personalised recommendation.</p>
                                    <a href="{{ url('/gift-finder') }}" class="text-xs font-bold text-red-950 hover:text-fuchsia-800 transition-colors">Try it free →</a>
                                </div>
                            </div>

                        </div>

                        <div class="border-t border-gray-100 px-6 py-2.5 flex items-center justify-between bg-gray-50/80 rounded-b-2xl">
                            <span class="text-xs text-gray-400">200+ products · min. 1 piece · 24–72h turnaround</span>
                            <a href="{{ url('/shop') }}" class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors">View Full Shop →</a>
                        </div>

                    </div>
                </div>{{-- end shop mega --}}

                @foreach([
                    ['Gift Ideas',  'gift-ideas'],
                    ['Bulk Orders', 'bulk-orders'],
                    ['About',       'about'],
                    ['Contact',     'contact'],
                ] as [$label, $seg])
                <a href="{{ url('/' . $seg) }}"
                   class="text-sm font-medium transition-colors duration-150
                          {{ request()->is($seg) ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">
                    {{ $label }}
                </a>
                @endforeach

            </div>

            {{-- ════════════════════════════
                 DESKTOP RIGHT ACTIONS
            ════════════════════════════ --}}
            <div class="hidden lg:flex items-center gap-2.5">

                {{-- Cart icon --}}
                <a href="{{ url('/cart') }}"
                   class="relative flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200
                          text-gray-500 hover:border-gray-300 hover:bg-gray-50 transition-all duration-150"
                   aria-label="Cart">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1.5 min-w-[16px] h-4 rounded-full
                                 bg-gradient-to-r from-red-600 to-red-950
                                 text-white text-[9px] font-extrabold flex items-center justify-center px-0.5">
                        0
                    </span>
                </a>

                <a href="{{ url('/track-order') }}"
                   class="text-xs font-bold text-gray-700 border border-gray-200 px-4 py-2 rounded-lg
                          hover:bg-gray-900 hover:text-white hover:border-gray-900 transition-all duration-150">
                    Track Order
                </a>

                {{-- ── GUEST ── --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="text-xs font-bold text-white px-4 py-2 rounded-lg shadow-sm shadow-red-200
                              bg-gradient-to-r from-red-600 to-red-950 hover:opacity-90 transition-opacity duration-150">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="text-xs font-bold text-red-600 border border-red-200 px-4 py-2 rounded-lg
                              hover:bg-red-50 transition-colors duration-150">
                        Sign Up
                    </a>
                @endguest

                {{-- ── AUTHENTICATED USER ── --}}
                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 bg-transparent border-0 p-0 cursor-pointer">
                            <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=DC2626&color=fff&size=32' }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover border-2 border-red-100">
                            <span class="text-sm font-semibold text-gray-700 max-w-[90px] truncate">
                                {{ Str::words(Auth::user()->name, 1, '') }}
                            </span>
                            <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 group-hover:rotate-180"
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div class="absolute right-0 top-full mt-2 w-52 bg-white rounded-xl
                                    border border-gray-100 shadow-xl shadow-gray-200/60
                                    opacity-0 invisible -translate-y-1 pointer-events-none
                                    group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:pointer-events-auto
                                    transition-all duration-200">

                            <div class="p-3 border-b border-gray-100">
                                <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-1.5 space-y-0.5">
                                @foreach([
                                    ['My Account',  '/account',     'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                                    ['My Orders',   '/orders',      'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                                    ['Track Order', '/track-order', 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                                ] as [$label, $href, $icon])
                                <a href="{{ url($href) }}"
                                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-600
                                          hover:bg-gray-50 hover:text-gray-800 transition-colors duration-100">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
                                    </svg>
                                    {{ $label }}
                                </a>
                                @endforeach
                            </div>

                            <div class="p-1.5 border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg
                                                   text-sm text-red-600 font-medium hover:bg-red-50 transition-colors duration-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endauth

            </div>

            {{-- ════════════════════════════
                 MOBILE TOGGLE BUTTONS
            ════════════════════════════ --}}
            <div class="flex lg:hidden items-center gap-3">

                <a href="{{ url('/cart') }}" class="relative" aria-label="Cart">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="absolute -top-1 -right-1.5 min-w-[14px] h-3.5 rounded-full bg-red-600
                                 text-white text-[8px] font-extrabold flex items-center justify-center px-0.5">0</span>
                </a>

                <button @click="open = !open" class="flex flex-col gap-1.5 p-1 -mr-1" aria-label="Menu">
                    <span class="block w-5 h-0.5 bg-gray-700 rounded transition-all duration-300"
                          :class="open ? 'translate-y-2 rotate-45' : ''"></span>
                    <span class="block w-5 h-0.5 bg-gray-700 rounded transition-all duration-300"
                          :class="open ? 'opacity-0' : ''"></span>
                    <span class="block w-5 h-0.5 bg-gray-700 rounded transition-all duration-300"
                          :class="open ? '-translate-y-2 -rotate-45' : ''"></span>
                </button>

            </div>

        </div>

        {{-- ════════════════════════════
             MOBILE DRAWER
        ════════════════════════════ --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-end="opacity-0 -translate-y-2"
             x-cloak
             class="lg:hidden -mx-5 sm:-mx-8 px-5 sm:px-8 pb-6 bg-white border-t border-gray-100">

            {{-- Auth user info --}}
            @auth
            <div class="flex items-center gap-3 py-4 border-b border-gray-100 mb-1">
                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=DC2626&color=fff&size=32' }}"
                     alt="{{ Auth::user()->name }}"
                     class="w-9 h-9 rounded-full object-cover border-2 border-red-100">
                <div>
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>
            @endauth

            <a href="{{ url('/') }}"
               class="flex justify-between py-3.5 border-b border-gray-100 text-sm font-semibold
                      text-gray-700 hover:text-red-600 transition-colors">
                Home
            </a>

            {{-- Shop accordion --}}
            <div class="border-b border-gray-100">
                <button @click="shopOpen = !shopOpen"
                        class="flex items-center justify-between w-full py-3.5 text-sm font-semibold text-gray-700">
                    <span>Shop</span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                         :class="shopOpen ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="shopOpen" x-transition x-cloak class="pb-3">
                    <p class="text-[9px] font-extrabold tracking-widest uppercase text-red-500 mt-2 mb-1 pl-3">Apparel</p>
                    <a href="{{ url('/shop/dtf-tshirts') }}" class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-600 transition-colors"><span class="w-1 h-1 rounded-full bg-red-400"></span>DTF T-Shirts</a>
                    <a href="{{ url('/shop/uvdtf') }}"        class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-600 transition-colors"><span class="w-1 h-1 rounded-full bg-red-400"></span>UV DTF Prints</a>
                    <a href="{{ url('/shop/hoodies') }}"      class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-600 transition-colors"><span class="w-1 h-1 rounded-full bg-red-400"></span>Custom Hoodies</a>

                    <p class="text-[9px] font-extrabold tracking-widest uppercase text-red-950 mt-3 mb-1 pl-3">Gifts</p>
                    <a href="{{ url('/shop/mugs') }}"         class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-950 transition-colors"><span class="w-1 h-1 rounded-full bg-red-950"></span>Custom Mugs</a>
                    <a href="{{ url('/shop/gift-boxes') }}"   class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-950 transition-colors"><span class="w-1 h-1 rounded-full bg-red-950"></span>Gift Boxes</a>
                    <a href="{{ url('/shop/frames') }}"       class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-red-950 transition-colors"><span class="w-1 h-1 rounded-full bg-red-950"></span>Photo Frames</a>

                    <p class="text-[9px] font-extrabold tracking-widest uppercase text-yellow-600 mt-3 mb-1 pl-3">Engraving</p>
                    <a href="{{ url('/shop/engraved-pens') }}"  class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-yellow-600 transition-colors"><span class="w-1 h-1 rounded-full bg-yellow-400"></span>Engraved Pens</a>
                    <a href="{{ url('/shop/acrylic-awards') }}" class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-yellow-600 transition-colors"><span class="w-1 h-1 rounded-full bg-yellow-400"></span>Acrylic Awards</a>

                    <p class="text-[9px] font-extrabold tracking-widest uppercase text-gray-400 mt-3 mb-1 pl-3">Corporate</p>
                    <a href="{{ url('/shop/offset') }}"      class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 transition-colors"><span class="w-1 h-1 rounded-full bg-gray-400"></span>Offset Printing</a>
                    <a href="{{ url('/shop/packaging') }}"   class="flex items-center gap-2 pl-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 transition-colors"><span class="w-1 h-1 rounded-full bg-gray-400"></span>Packaging</a>

                    <a href="{{ url('/shop') }}" class="flex items-center gap-1 pl-3 py-2 mt-1 text-xs font-bold text-red-600 hover:text-red-700">View All Products →</a>
                </div>
            </div>

            @foreach([['Gift Ideas','gift-ideas'],['Bulk Orders','bulk-orders'],['About','about'],['Contact','contact']] as [$label,$seg])
            <a href="{{ url('/'.$seg) }}"
               class="flex justify-between py-3.5 border-b border-gray-100 text-sm font-semibold
                      text-gray-700 hover:text-red-600 transition-colors">
                {{ $label }}
            </a>
            @endforeach

            <div class="mt-4 flex flex-col gap-2.5">
                <a href="{{ url('/track-order') }}"
                   class="text-center py-2.5 text-sm font-bold text-gray-800 border border-gray-200
                          rounded-xl hover:bg-gray-50 transition-colors">
                    Track Order
                </a>

                @guest
                <a href="{{ route('login') }}"
                   class="text-center py-2.5 text-sm font-bold text-white rounded-xl
                          bg-gradient-to-r from-red-600 to-red-950 hover:opacity-90 transition-opacity">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="text-center py-2.5 text-sm font-bold text-red-600 border border-red-200
                          rounded-xl hover:bg-red-50 transition-colors">
                    Create Account
                </a>
                @endguest

                @auth
                <a href="{{ url('/account') }}"
                   class="text-center py-2.5 text-sm font-bold text-red-950 border border-fuchsia-200
                          rounded-xl hover:bg-fuchsia-50 transition-colors">
                    My Account
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full py-2.5 text-sm font-bold text-red-600 border border-red-200
                                   rounded-xl hover:bg-red-50 transition-colors">
                        Sign Out
                    </button>
                </form>
                @endauth
            </div>

        </div>

    </nav>
</header>