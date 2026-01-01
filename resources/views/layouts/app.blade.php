<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CIPA STORE') }} - Fashion & Lifestyle</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Outfit'] antialiased text-slate-800 bg-white flex flex-col min-h-screen">
    
    <!-- Navigation -->
    <header class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tighter text-slate-900 group">
                        CIPA<span class="text-indigo-600 group-hover:text-indigo-500 transition-colors">STORE</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">All</a>
                    <a href="{{ route('home', ['category' => 'baju']) }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Baju</a>
                    <a href="{{ route('home', ['category' => 'celana-rok']) }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Celana/Rok</a>
                    <a href="{{ route('home', ['category' => 'sepatu']) }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Sepatu</a>
                    <a href="{{ route('home', ['category' => 'hijab']) }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Hijab</a>
                    <a href="{{ route('home', ['category' => 'aksesoris']) }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Aksesoris</a>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-6">
                    <button class="text-slate-600 hover:text-indigo-600 transition-colors">
                        <span class="sr-only">Search</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                    <a href="{{ route('cart.index') }}" class="text-slate-600 hover:text-indigo-600 transition-colors relative">
                        <span class="sr-only">Cart</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-indigo-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $cartCount }}</span>
                        @endif
                    </a>
                    
                    @if (Route::has('login'))
                        <div class="hidden md:flex items-center space-x-4 pl-4 border-l border-gray-200">
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="text-sm font-medium text-slate-900 hover:text-indigo-600">Admin Dashboard</a>
                                @else
                                    <a href="{{ route('orders.index') }}" class="text-sm font-medium text-slate-900 hover:text-indigo-600">My Orders</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Log out</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm font-medium bg-slate-900 text-white px-4 py-2 rounded-full hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/20">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">All</a>
                <a href="{{ route('home', ['category' => 'baju']) }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Baju</a>
                <a href="{{ route('home', ['category' => 'celana-rok']) }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Celana/Rok</a>
                <a href="{{ route('home', ['category' => 'sepatu']) }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Sepatu</a>
                <a href="{{ route('home', ['category' => 'hijab']) }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Hijab</a>
                <a href="{{ route('home', ['category' => 'aksesoris']) }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg">Aksesoris</a>
                
                <div class="border-t border-gray-100 my-2 pt-2">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/admin/dashboard') }}" class="block px-3 py-2 text-base font-medium text-slate-900 hover:text-indigo-600">Admin Dashboard</a>
                        @else
                            <a href="{{ route('orders.index') }}" class="block px-3 py-2 text-base font-medium text-slate-900 hover:text-indigo-600">My Orders</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600">Log out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-slate-600 hover:text-indigo-600">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-indigo-600 hover:text-indigo-700">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <script>
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        @if(session('success'))
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">CIPA STORE</h3>
                    <p class="text-sm leading-relaxed">Your premium destination for fashion, accessories, and footwear. Quality meets style.</p>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">All Products</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Best Sellers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping & Returns</a></li>
                        <li><a href="https://wa.me/6281234567890" target="_blank" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Newsletter</h4>
                    <form class="flex flex-col space-y-2">
                        <input type="email" placeholder="Enter your email" class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-500 transition-colors">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-xs">
                &copy; {{ date('Y') }} Cipa Store. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
