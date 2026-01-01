@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-slate-50 py-20 lg:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-100 to-purple-100"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="text-indigo-600 font-bold tracking-wider uppercase text-sm mb-4 block">Inspiration</span>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-slate-900 mb-6">
                The Lookbook <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">2025 Collection</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Discover the stories behind our latest styles. Curated outfits for every occasion, designed to make you feel confident and unique.
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="columns-1 md:columns-2 lg:columns-3 gap-8 space-y-8">
                @foreach($lookbooks as $look)
                <div class="break-inside-avoid bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                    <div class="relative">
                        <img src="{{ $look['image'] }}" alt="{{ $look['title'] }}" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-4 group-hover:translate-y-0 transition-transform duration-300 opacity-0 group-hover:opacity-100">
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-full mb-3 border border-white/30">
                                {{ strtoupper($look['category_slug']) }}
                            </span>
                             <h3 class="text-xl font-bold text-white mb-2">{{ $look['title'] }}</h3>
                             <p class="text-slate-100 text-sm mb-4">{{ $look['description'] }}</p>
                             <a href="{{ route('home', ['category' => $look['category_slug']]) }}" class="inline-flex items-center text-white font-bold text-sm hover:underline">
                                Shop This Style <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                             </a>
                        </div>
                    </div>
                    <!-- Visible content below image for mobile/default view if hover is tricky, but here we do overlay-only for clean look or add minimal below -->
                    <div class="p-6 md:hidden">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $look['title'] }}</h3>
                        <p class="text-slate-600 text-sm mb-4">{{ $look['description'] }}</p>
                        <a href="{{ route('home', ['category' => $look['category_slug']]) }}" class="text-indigo-600 font-bold text-sm hover:text-indigo-800">
                            Shop {{ ucfirst($look['category_slug']) }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <p class="text-slate-600 mb-6">Want to see more?</p>
                <a href="{{ route('home') }}" class="inline-block px-8 py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/20">
                    Browse All Products
                </a>
            </div>

        </div>
    </section>
@endsection
