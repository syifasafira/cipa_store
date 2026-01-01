@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-slate-50 overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 flex flex-col-reverse lg:flex-row items-center">

            <!-- Text Content -->
            <div class="lg:w-1/2 lg:pr-12 text-center lg:text-left z-10">
                <div class="inline-block px-3 py-1 mb-4 bg-indigo-50 rounded-full">
                    <span class="text-xs font-bold tracking-wide uppercase text-indigo-600">New Collection
                        {{ now()->year }}</span>
                </div>
                <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                    Discover Your <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Unique
                        Style</span>
                </h1>
                <p class="text-lg text-slate-600 mb-8 max-w-lg mx-auto lg:mx-0">
                    Explore our curated collection of premium fashion, accessories, and footwear designed for the modern
                    individual.
                </p>
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a href="#products"
                        class="px-8 py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-900/20 transition-all transform hover:-translate-y-1">
                        Shop Now
                    </a>
                    <a href="{{ route('lookbook') }}"
                        class="px-8 py-4 bg-white text-slate-900 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all">
                        View Lookbook
                    </a>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="lg:w-1/2 relative mb-12 lg:mb-0">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-indigo-200/50 to-purple-200/50 rounded-full blur-3xl opacity-60 animate-pulse">
                </div>
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&q=80&w=2070"
                    alt="Fashion Model"
                    class="relative w-full h-[500px] object-cover rounded-3xl shadow-2xl shadow-indigo-500/10 rotate-2 hover:rotate-0 transition-transform duration-500">
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-3">Shop by Category</h2>
                <p class="text-slate-600">Find exactly what you're looking for</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $placeholders = [
                        'baju' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&q=80&w=800',
                        'celana-rok' => 'https://images.pexels.com/photos/9491057/pexels-photo-9491057.jpeg',
                        'sepatu' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&q=80&w=800',
                        'hijab' => 'https://images.pexels.com/photos/2253415/pexels-photo-2253415.jpeg',
                        'aksesoris' => 'https://images.unsplash.com/photo-1576053139778-7e32f2ae3cfd?auto=format&fit=crop&q=80&w=800',
                        'default' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&q=80&w=800'
                    ];
                @endphp

                @foreach($categories as $category)
                    <div class="group relative overflow-hidden rounded-2xl cursor-pointer bg-slate-100 h-96">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent z-10"></div>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $category->name }}">
                        @else
                            @php
                                $fallbackImage = $placeholders[$category->slug] ?? $placeholders['default'];
                            @endphp
                            <img src="{{ $fallbackImage }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $category->name }}">
                        @endif

                        <a href="{{ route('home', ['category' => $category->slug]) }}" class="absolute inset-0 z-30"></a>

                        <div class="absolute bottom-6 left-6 z-20 pointer-events-none">
                            <h3 class="text-2xl font-bold text-white mb-1">{{ $category->name }}</h3>
                            <p class="text-slate-200 text-sm">{{ $category->products_count }} Products</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Preview -->
    <section id="products" class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">New Arrivals</h2>
                    <p class="text-slate-600">Handpicked selections just for you</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 group">
                        <div class="relative bg-gray-100 aspect-[4/5] overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $product->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="Placeholder">
                            @endif

                            <!-- Quick Action -->
                            <div
                                class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-4 group-hover:translate-y-0">
                                <a href="{{ route('product.show', $product) }}"
                                    class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold shadow-lg hover:bg-slate-900 hover:text-white transition-colors text-sm">
                                    View Product
                                </a>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-xs text-slate-500 mb-1">{{ $product->category->name }}</div>
                            <h3 class="font-bold text-slate-900 mb-2 truncate">
                                <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-900 font-bold">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection