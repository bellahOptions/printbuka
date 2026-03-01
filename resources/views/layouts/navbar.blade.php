<header class="bg-white sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto py-3 px-6 lg:px-10" x-data="{ open:false, mobileShop:false }">

        <div class="flex justify-between items-center py-4">

            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.svg') }}" alt="PrintBuka Logo" class="w-32">
            </a>

            <!-- ================= DESKTOP NAV ================= -->
            <div class="hidden lg:flex items-center space-x-8">

                <a href="{{ url('/') }}" class="font-medium hover:text-red-600">
                    Home
                </a>

                <!-- MEGA MENU (HOVER ONLY) -->
                <div class="relative group">

                    <button class="flex items-center gap-1 font-medium hover:text-red-600">
                        Shop
                        <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Mega Menu Panel -->
                    <div class="absolute left-0 top-full mt-4 w-[900px]
                                opacity-0 invisible
                                group-hover:opacity-100 group-hover:visible
                                transition-all duration-300
                                bg-white shadow-xl rounded-xl p-8">

                        <div class="grid grid-cols-4 gap-8">

                            <div>
                                <h3 class="font-semibold mb-4">Apparel Branding</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><a href="#">DTF T-Shirts</a></li>
                                    <li><a href="#">UV DTF Prints</a></li>
                                    <li><a href="#">Custom Hoodies</a></li>
                                    <li><a href="#">Uniform Branding</a></li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-4">Custom Gifts</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><a href="#">Custom Mugs</a></li>
                                    <li><a href="#">Gift Boxes</a></li>
                                    <li><a href="#">Photo Frames</a></li>
                                    <li><a href="#">Branded Bottles</a></li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-4">Laser Engraving</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><a href="#">Engraved Pens</a></li>
                                    <li><a href="#">Wooden Gifts</a></li>
                                    <li><a href="#">Acrylic Awards</a></li>
                                    <li><a href="#">Name Plates</a></li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="font-semibold mb-4">Corporate & Bulk</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><a href="#">Offset Printing</a></li>
                                    <li><a href="#">Business Cards</a></li>
                                    <li><a href="#">Brochures</a></li>
                                    <li><a href="#">Packaging</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

                <a href="{{ url('/gift-ideas') }}" class="font-medium hover:text-red-600">
                    Gift Ideas
                </a>

                <a href="{{ url('/bulk-orders') }}" class="font-medium hover:text-red-600">
                    Bulk Orders
                </a>

                <a href="{{ url('/about') }}" class="font-medium hover:text-red-600">
                    About
                </a>

                <a href="{{ url('/contact') }}" class="font-medium hover:text-red-600">
                    Contact
                </a>

                <a href="{{ url('/track-order') }}"
                   class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-black">
                   Track Order
                </a>

                <a href="{{ url('/login') }}"
                   class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                   Login
                </a>

            </div>

            <!-- ================= MOBILE TOGGLE ================= -->
            <button @click="open = !open" class="lg:hidden">
                <svg class="w-7 h-7" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

        </div>

        <!-- ================= MOBILE MENU ================= -->
       <!-- ================= MOBILE MENU ================= -->
<div x-show="open"
     x-transition
     x-cloak
     class="lg:hidden pb-6 space-y-4">

    <a href="{{ url('/') }}" class="block">Home</a>

    <!-- Mobile Shop Toggle -->
    <div>
        <button @click="mobileShop = !mobileShop"
                class="w-full text-left font-medium">
            Shop
        </button>

        <div x-show="mobileShop"
             x-transition
             x-cloak
             class="pl-4 mt-2 space-y-2 text-gray-600">

            <a href="#" class="block">DTF T-Shirts</a>
            <a href="#" class="block">Custom Mugs</a>
            <a href="#" class="block">Laser Engraving</a>
            <a href="#" class="block">Corporate Printing</a>
        </div>
    </div>

    <a href="{{ url('/gift-ideas') }}" class="block">Gift Ideas</a>
    <a href="{{ url('/bulk-orders') }}" class="block">Bulk Orders</a>
    <a href="{{ url('/about') }}" class="block">About</a>
    <a href="{{ url('/contact') }}" class="block">Contact</a>
    <a href="{{ url('/track-order') }}" class="block">Track Order</a>

</div>

    </nav>
</header>