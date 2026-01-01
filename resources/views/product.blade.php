@extends('layouts.app')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Product Images -->
            <div class="lg:w-1/2">
                <div class="rounded-2xl overflow-hidden bg-gray-100 aspect-square">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800" alt="Placeholder" class="w-full h-full object-cover">
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="lg:w-1/2">
                <div class="mb-2">
                    <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                        {{ $product->category->name }}
                    </span>
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 mb-4">{{ $product->name }}</h1>
                <p class="text-2xl font-bold text-slate-900 mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <div class="prose prose-slate mb-8 text-gray-600">
                    <p>{{ $product->description }}</p>
                </div>

                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button type="button" onclick="decrementQuantity()" class="px-4 py-2 text-gray-600 hover:bg-gray-50">-</button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-16 text-center border-none focus:ring-0">
                            <button type="button" onclick="incrementQuantity()" class="px-4 py-2 text-gray-600 hover:bg-gray-50">+</button>
                        </div>
                        <div class="text-sm text-gray-500">
                            Stock: {{ $product->stock }} available
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-slate-800 transition-colors">
                            Add to Cart
                        </button>
                        <button type="button" class="w-14 h-14 flex items-center justify-center border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </form>

                <script>
                    function incrementQuantity() {
                        const input = document.getElementById('quantity');
                        input.value = parseInt(input.value) + 1;
                    }
                    function decrementQuantity() {
                        const input = document.getElementById('quantity');
                        if (input.value > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    }
                </script>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-20">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 group">
                    <div class="relative bg-gray-100 aspect-[4/5] overflow-hidden">
                        @if($related->image)
                            <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $related->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Placeholder">
                        @endif
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-4 group-hover:translate-y-0">
                            <a href="{{ route('product.show', $related) }}" class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold shadow-lg hover:bg-slate-900 hover:text-white transition-colors text-sm">
                                View
                            </a>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 mb-2 truncate">{{ $related->name }}</h3>
                        <div class="text-slate-900 font-bold">Rp {{ number_format($related->price, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
