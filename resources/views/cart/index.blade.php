@extends('layouts.app')

@section('content')
<div class="py-12 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Shopping Cart</h1>

        @if(session('success'))
            <div class="mb-6 p-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-slate-50 rounded-2xl p-6">
                        @foreach($cart as $id => $item)
                        <div class="flex items-center gap-4 py-6 border-b border-gray-200 last:border-0">
                            <div class="w-24 h-24 bg-white rounded-xl overflow-hidden flex-shrink-0">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-slate-900 mb-1">
                                    <a href="{{ route('product.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                </h3>
                                <div class="text-slate-600 mb-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                            </div>
                            <div class="flex items-center gap-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 rounded-lg border-gray-300 text-center text-sm focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                                </form>
                                <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-slate-50 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h2>
                        <div class="flex justify-between items-center mb-4 text-slate-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-6 text-slate-600">
                            <span>Shipping</span>
                            <span class="text-sm">Calculated at checkout</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between items-center mb-8">
                            <span class="font-bold text-lg text-slate-900">Total</span>
                            <span class="font-bold text-xl text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="block w-full bg-slate-900 text-white text-center py-4 rounded-xl font-bold hover:bg-slate-800 transition-colors">
                            Proceed to Checkout
                        </a>
                        <a href="/" class="block text-center mt-4 text-slate-600 hover:text-slate-900 text-sm">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 mb-2">Your cart is empty</h2>
                <p class="text-slate-600 mb-8">Looks like you haven't added anything to your cart yet.</p>
                <a href="/" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 transition-colors">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
