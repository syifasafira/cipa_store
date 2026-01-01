<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Order #{{ $order->code }}</h1>
            <p class="text-slate-500 mt-1">Placed on {{ $order->created_at->format('d M Y H:i') }} by {{ $order->user->name }}</p>
        </div>
        <div class="flex gap-3">
             <a href="{{ route('admin.orders.print', $order) }}" target="_blank" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2-4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print Label
            </a>
            <a href="{{ route('admin.orders.index') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Items -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-bold text-slate-900">Items Ordered</h2>
                </div>
                <div class="p-6">
                    @foreach($order->details as $detail)
                    <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                             @if($detail->product->image)
                                    <img src="{{ asset('storage/' . $detail->product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover">
                                @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-slate-900">{{ $detail->product->name }}</h3>
                            <div class="text-sm text-slate-500">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="font-bold text-slate-900">
                            Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center bg-gray-50 -mx-6 -mb-6 p-6">
                        <span class="font-bold text-lg text-slate-900">Total Amount</span>
                        <span class="font-bold text-xl text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            
             <!-- Customer Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-bold text-slate-900">Customer & Shipping</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Customer Name</div>
                        <div class="font-bold text-slate-900">{{ $order->user->name }}</div>
                        <div class="text-sm text-slate-500">{{ $order->user->email }}</div>
                         <div class="text-sm text-slate-500">{{ $order->user->phone_number }}</div>
                    </div>
                     <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Courier</div>
                        <div class="font-bold text-slate-900">{{ $order->courier }}</div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Shipping Address</div>
                        <div class="p-3 bg-gray-50 rounded-lg text-slate-700">
                             {{ $order->user->address ?? 'No address provided' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-bold text-slate-900">Update Order Status</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <x-label for="shipping_status" value="Shipping Status" />
                            <select name="shipping_status" id="shipping_status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="pending" {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="shipping" {{ $order->shipping_status == 'shipping' ? 'selected' : '' }}>Shipping / On Delivery</option>
                                <option value="delivered" {{ $order->shipping_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="tracking_number" value="Tracking Number (Resi)" />
                            <x-input id="tracking_number" type="text" name="tracking_number" class="block mt-1 w-full" :value="$order->tracking_number" placeholder="Enter receipt number" />
                            <p class="text-xs text-gray-500 mt-1">Required if status is "Shipping"</p>
                        </div>

                        <x-button class="w-full justify-center">
                            Update Order
                        </x-button>
                    </form>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                 <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-bold text-slate-900">Payment Info</h2>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-slate-600">Status</span>
                        <span class="font-bold {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                     <div class="flex justify-between items-center">
                        <span class="text-slate-600">Total</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
