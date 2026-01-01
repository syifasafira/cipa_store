@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Shipping Information -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-slate-900 mb-6">Shipping Information</h2>

                        <div class="space-y-4">
                            <div>
                                <x-label for="name" :value="__('Full Name')" />
                                <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" :value="Auth::user()->name" readonly autocomplete="name" />
                                <p class="text-xs text-gray-400 mt-1">Logged in as {{ Auth::user()->email }}</p>
                            </div>

                            <div>
                                <x-label for="phone_number" :value="__('Phone Number')" />
                                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number', Auth::user()->phone_number)" required placeholder="e.g 08123456789" autocomplete="tel" />
                                @error('phone_number')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-label for="address" :value="__('Shipping Address')" />
                                <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Full address including city and zip code" autocomplete="street-address">{{ old('address', Auth::user()->address) }}</textarea>
                                @error('address')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <x-label for="courier" :value="__('Courier')" />
                                <select id="courier" name="courier" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="JNE">JNE</option>
                                    <option value="J&T">J&T</option>
                                    <option value="Sicepat">Sicepat</option>
                                </select>
                                @error('courier')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-24">
                        <h2 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h2>
                        
                        <div class="space-y-3 mb-6">
                            @foreach($cart as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span class="text-slate-900 font-medium">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Shipping (Flat Rate)</span>
                                <span>Rp 20.000</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 flex justify-between items-center mb-8">
                            <span class="font-bold text-lg text-slate-900">Total</span>
                            <span class="font-bold text-xl text-indigo-600">Rp {{ number_format($total + 20000, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 text-white text-center py-4 rounded-xl font-bold hover:bg-slate-800 transition-colors">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
