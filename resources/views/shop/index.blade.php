{{--
    resources/views/pages/shop.blade.php
    Pure Tailwind CSS · No inline styles · DM Sans
    Ecommerce shop: header, gift spotlight, all products grid
--}}
@extends('layouts.theme')
@section('title', 'Shop — Custom Print & Gift Products | PrintBuka')
@section('content')

{{-- ════════════════════════════════════════════════
     SHOP HEADER
════════════════════════════════════════════════ --}}
<section class="shop-header bg-gray-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-10 pt-10 pb-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-6">
            <a href="{{ url('/') }}" class="hover:text-gray-600 transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-600 font-medium">Shop</span>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">
            <div>
                <h1 class="font-black text-gray-800 text-3xl sm:text-4xl mb-2">
                    Everything <span class="bg-gradient-to-r from-red-600 to-fuchsia-600 bg-clip-text text-transparent">Custom</span>
                </h1>
                <p class="text-gray-500 text-sm">200+ personalised products · Min. 1 piece · 24–72h turnaround</p>
            </div>

            {{-- Active category filter pills --}}
            <div class="flex flex-wrap gap-2" x-data="{ active: '{{ request('category', 'all') }}' }">
                @foreach([
                    ['all',       'All Products'],
                    ['tshirts',   '👕 T-Shirts'],
                    ['uvdtf',     '🖨️ UV DTF'],
                    ['laser',     '✍️ Engraving'],
                    ['gifts',     '🎁 Gifts'],
                    ['corporate', '🏢 Corporate'],
                ] as [$slug, $label])
                <a href="{{ url('/shop') }}?category={{ $slug }}"
                   class="px-3.5 py-1.5 rounded-full text-xs font-bold border transition-all duration-150
                          {{ request('category', 'all') === $slug
                              ? 'bg-gray-900 text-white border-gray-900'
                              : 'bg-white text-gray-600 border-gray-200 hover:border-gray-400 hover:text-gray-800' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Search + Sort row --}}
        <div class="flex flex-col sm:flex-row gap-3 mt-6">
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                     fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="search"
                       placeholder="Search products…"
                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-white
                              focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent
                              placeholder-gray-400 transition-all duration-150">
            </div>
            <select class="px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-white text-gray-700
                           focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent
                           cursor-pointer transition-all duration-150">
                <option value="latest">Sort: Latest</option>
                <option value="popular">Most Popular</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
                <option value="name-asc">Name: A–Z</option>
            </select>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════════
     GIFT ITEMS SPOTLIGHT (TOP PRODUCTS)
════════════════════════════════════════════════ --}}
<section class="gift-items bg-white py-12 sm:py-16 px-5 sm:px-8 lg:px-10 border-b border-gray-100">
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold
                             tracking-widest uppercase bg-gradient-to-r from-orange-100 to-pink-100
                             text-fuchsia-700 mb-2">
                    🎁 Most Gifted
                </span>
                <h2 class="font-black text-gray-800 text-xl sm:text-2xl">Top Gift Items</h2>
            </div>
            <a href="{{ url('/shop?category=gifts') }}"
               class="text-xs font-bold text-red-600 hover:text-red-700 transition-colors flex items-center gap-1">
                See All Gifts
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                </svg>
            </a>
        </div>

        @php
        $giftItems = [
            ['name'=>'Custom Photo Mug','sub'=>'11oz Ceramic · Any Photo or Text','price'=>'₦3,500','badge'=>'Bestseller','img'=>'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=400&auto=format&fit=crop&q=80','color'=>'red'],
            ['name'=>'Engraved Keychain','sub'=>'Metal · Name or Logo','price'=>'₦2,000','badge'=>'Popular','img'=>'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&auto=format&fit=crop&q=80','color'=>'yellow'],
            ['name'=>'Custom Tote Bag','sub'=>'Canvas · Full-colour DTF','price'=>'₦4,200','badge'=>'New','img'=>'https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=400&auto=format&fit=crop&q=80','color'=>'fuchsia'],
            ['name'=>'Branded Cap','sub'=>'Adjustable · Embroidered or Printed','price'=>'₦5,500','badge'=>null,'img'=>'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&auto=format&fit=crop&q=80','color'=>'red'],
            ['name'=>'Photo Frame','sub'=>'Wooden · Engraved or Printed','price'=>'₦6,000','badge'=>'New','img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&auto=format&fit=crop&q=80','color'=>'yellow'],
            ['name'=>'Custom Gift Box','sub'=>'Curated · Branded Ribbon','price'=>'From ₦12,000','badge'=>'Premium','img'=>'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=400&auto=format&fit=crop&q=80','color'=>'fuchsia'],
        ];
        $badgeColor = ['Bestseller'=>'bg-red-600','Popular'=>'bg-fuchsia-600','New'=>'bg-green-600','Premium'=>'bg-yellow-500'];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($giftItems as $item)
            <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden
                        hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-200/60 transition-all duration-250">
                <div class="relative aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ $item['img'] }}"
                         alt="{{ $item['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @if($item['badge'])
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-[10px] font-extrabold text-white {{ $badgeColor[$item['badge']] ?? 'bg-gray-700' }}">
                        {{ $item['badge'] }}
                    </span>
                    @endif
                    <button class="absolute top-2 right-2 w-7 h-7 rounded-full bg-white/80 backdrop-blur-sm
                                   flex items-center justify-center opacity-0 group-hover:opacity-100
                                   hover:bg-white transition-all duration-150" aria-label="Wishlist">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
                <div class="p-3">
                    <p class="font-bold text-gray-800 text-xs leading-snug mb-0.5">{{ $item['name'] }}</p>
                    <p class="text-gray-400 text-[10px] mb-2">{{ $item['sub'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="font-black text-sm text-gray-800">{{ $item['price'] }}</span>
                        <a href="{{ url('/shop/product') }}"
                           class="w-6 h-6 rounded-lg bg-gray-100 hover:bg-gradient-to-r hover:from-red-600 hover:to-fuchsia-600
                                  flex items-center justify-center group/btn transition-all duration-150">
                            <svg class="w-3 h-3 text-gray-600 group-hover/btn:text-white transition-colors duration-150"
                                 fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════════
     ALL PRODUCTS — DEFAULT: SORT BY LATEST
════════════════════════════════════════════════ --}}
<section class="all-products bg-gray-50 py-12 sm:py-16 px-5 sm:px-8 lg:px-10">
    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <h2 class="font-black text-gray-800 text-xl sm:text-2xl">
                All Products
                <span class="font-medium text-gray-400 text-base ml-2">— sorted by latest</span>
            </h2>
            {{-- Results count --}}
            <span class="text-xs text-gray-400 hidden sm:block">Showing 24 of 200+ products</span>
        </div>

        @php
        $products = [
            // T-Shirts
            ['name'=>'DTF Custom T-Shirt','cat'=>'T-Shirt Printing','price'=>'From ₦1,900','rating'=>5,'reviews'=>42,'img'=>'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&auto=format&fit=crop&q=80','badge'=>'Bestseller','badge_color'=>'bg-red-600','tag'=>'tshirts'],
            ['name'=>'Custom Hoodie (DTF)','cat'=>'T-Shirt Printing','price'=>'From ₦4,500','rating'=>5,'reviews'=>18,'img'=>'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'tshirts'],
            ['name'=>'Team Jersey','cat'=>'T-Shirt Printing','price'=>'From ₦2,200','rating'=>4,'reviews'=>31,'img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&auto=format&fit=crop&q=80','badge'=>'Popular','badge_color'=>'bg-fuchsia-600','tag'=>'tshirts'],

            // UV DTF
            ['name'=>'Branded Tumbler (UV DTF)','cat'=>'UV DTF Printing','price'=>'From ₦4,000','rating'=>5,'reviews'=>27,'img'=>'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=400&auto=format&fit=crop&q=80','badge'=>'New','badge_color'=>'bg-green-600','tag'=>'uvdtf'],
            ['name'=>'Custom Phone Case','cat'=>'UV DTF Printing','price'=>'From ₦2,800','rating'=>4,'reviews'=>15,'img'=>'https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'uvdtf'],
            ['name'=>'UV DTF Branded Bottle','cat'=>'UV DTF Printing','price'=>'From ₦3,500','rating'=>5,'reviews'=>22,'img'=>'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=400&auto=format&fit=crop&q=80','badge'=>'Popular','badge_color'=>'bg-fuchsia-600','tag'=>'uvdtf'],

            // Laser
            ['name'=>'Engraved Wooden Plaque','cat'=>'Laser Engraving','price'=>'From ₦5,500','rating'=>5,'reviews'=>39,'img'=>'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&auto=format&fit=crop&q=80','badge'=>'Premium','badge_color'=>'bg-yellow-500','tag'=>'laser'],
            ['name'=>'Acrylic Award Trophy','cat'=>'Laser Engraving','price'=>'From ₦8,000','rating'=>5,'reviews'=>12,'img'=>'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'laser'],
            ['name'=>'Engraved Pen Set','cat'=>'Laser Engraving','price'=>'From ₦3,200','rating'=>4,'reviews'=>20,'img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&auto=format&fit=crop&q=80','badge'=>'New','badge_color'=>'bg-green-600','tag'=>'laser'],

            // Direct Image
            ['name'=>'Photo Canvas Print','cat'=>'Direct Image','price'=>'From ₦7,500','rating'=>5,'reviews'=>33,'img'=>'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400&auto=format&fit=crop&q=80','badge'=>'New','badge_color'=>'bg-green-600','tag'=>'direct-image'],
            ['name'=>'Custom Foam Board','cat'=>'Direct Image','price'=>'From ₦4,500','rating'=>4,'reviews'=>9,'img'=>'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'direct-image'],
            ['name'=>'Signage Print','cat'=>'Direct Image','price'=>'From ₦6,000','rating'=>4,'reviews'=>17,'img'=>'https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'direct-image'],

            // Gifts
            ['name'=>'Custom Mug','cat'=>'Gift Items','price'=>'₦3,500','rating'=>5,'reviews'=>88,'img'=>'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&auto=format&fit=crop&q=80','badge'=>'Bestseller','badge_color'=>'bg-red-600','tag'=>'gifts'],
            ['name'=>'Personalised Notebook','cat'=>'Gift Items','price'=>'₦4,800','rating'=>4,'reviews'=>24,'img'=>'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'gifts'],
            ['name'=>'Custom Keychain','cat'=>'Gift Items','price'=>'₦2,000','rating'=>5,'reviews'=>55,'img'=>'https://images.unsplash.com/photo-1503341504253-dff4815485f1?w=400&auto=format&fit=crop&q=80','badge'=>'Popular','badge_color'=>'bg-fuchsia-600','tag'=>'gifts'],

            // Corporate
            ['name'=>'Branded Business Cards','cat'=>'Corporate','price'=>'From ₦15,000/500pcs','rating'=>5,'reviews'=>41,'img'=>'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'corporate'],
            ['name'=>'Corporate Uniform Set','cat'=>'Corporate','price'=>'From ₦2,200/pc','rating'=>5,'reviews'=>29,'img'=>'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?w=400&auto=format&fit=crop&q=80','badge'=>'Popular','badge_color'=>'bg-fuchsia-600','tag'=>'corporate'],
            ['name'=>'Branded Tote Bags (Bulk)','cat'=>'Corporate','price'=>'From ₦3,500/pc','rating'=>4,'reviews'=>16,'img'=>'https://images.unsplash.com/photo-1607344645866-009c320b63e0?w=400&auto=format&fit=crop&q=80','badge'=>null,'badge_color'=>'','tag'=>'corporate'],
        ];

        // Filter by category if set
        $activeCategory = request('category', 'all');
        $filtered = $activeCategory === 'all' ? $products : array_filter($products, fn($p) => $p['tag'] === $activeCategory);
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
            @foreach($filtered as $product)
            <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden
                        hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-200/60 transition-all duration-250">

                {{-- Image --}}
                <div class="relative overflow-hidden bg-gray-100" style="aspect-ratio: 4/3">
                    <img src="{{ $product['img'] }}"
                         alt="{{ $product['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    @if($product['badge'])
                    <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-[9px] font-extrabold text-white {{ $product['badge_color'] }}">
                        {{ $product['badge'] }}
                    </span>
                    @endif

                    {{-- Quick action overlay --}}
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-200
                                flex items-center justify-center">
                        <a href="{{ url('/shop/product') }}"
                           class="px-4 py-2 rounded-xl text-xs font-bold text-white
                                  bg-gradient-to-r from-red-600 to-fuchsia-600 shadow-lg
                                  -translate-y-1 group-hover:translate-y-0 transition-transform duration-200">
                            Order Now
                        </a>
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-3">
                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">{{ $product['cat'] }}</p>
                    <p class="font-bold text-gray-800 text-xs leading-snug mb-1.5">{{ $product['name'] }}</p>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-2">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-2.5 h-2.5 {{ $i <= $product['rating'] ? 'text-yellow-400' : 'text-gray-200' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                        <span class="text-[9px] text-gray-400">({{ $product['reviews'] }})</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="font-black text-sm text-gray-800">{{ $product['price'] }}</span>
                        <button class="w-6 h-6 rounded-lg bg-gray-100 hover:bg-gradient-to-r hover:from-red-600 hover:to-fuchsia-600
                                       flex items-center justify-center group/btn transition-all duration-150"
                                aria-label="Add to cart">
                            <svg class="w-3 h-3 text-gray-600 group-hover/btn:text-white transition-colors duration-150"
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Load more --}}
        <div class="mt-10 flex justify-center">
            <button class="inline-flex items-center gap-2 px-8 py-3 rounded-xl text-sm font-bold text-gray-700
                           border-2 border-gray-200 hover:border-gray-800 hover:bg-gray-800 hover:text-white
                           transition-all duration-200">
                Load More Products
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════════════
     SERVICES STRIP
════════════════════════════════════════════════ --}}
<section class="bg-white py-10 px-5 sm:px-8 lg:px-10 border-t border-gray-100">
    <div class="max-w-7xl mx-auto">
        <p class="text-xs font-extrabold tracking-widest uppercase text-gray-400 text-center mb-6">Browse by Service</p>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach([
                ['DTF T-Shirt Printing',  '/services/dtf',          'bg-red-50 text-red-600 border-red-100 hover:bg-red-100'],
                ['UV DTF Printing',       '/services/uvdtf',        'bg-fuchsia-50 text-fuchsia-600 border-fuchsia-100 hover:bg-fuchsia-100'],
                ['Laser Engraving',       '/services/laser',        'bg-yellow-50 text-yellow-700 border-yellow-100 hover:bg-yellow-100'],
                ['Direct Image Printing', '/services/direct-image', 'bg-orange-50 text-orange-600 border-orange-100 hover:bg-orange-100'],
                ['Custom Gift Items',     '/shop?category=gifts',   'bg-pink-50 text-pink-600 border-pink-100 hover:bg-pink-100'],
            ] as [$label, $href, $cls])
            <a href="{{ url($href) }}"
               class="px-4 py-2 rounded-full text-xs font-bold border transition-colors duration-150 {{ $cls }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection