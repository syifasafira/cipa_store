@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-slate-900">Order #{{ $transaction->code }}</h1>
            <a href="{{ route('orders.index') }}" class="text-slate-600 hover:text-slate-900 font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Orders
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Order Details -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h2 class="font-bold text-slate-900">Items Ordered</h2>
                    </div>
                    <div class="p-6">
                        @foreach($transaction->details as $detail)
                        <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
                            <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($detail->product->image)
                                    <img src="{{ asset('storage/' . $detail->product->image) }}" alt="{{ $detail->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-900">{{ $detail->product->name }}</h3>
                                <div class="text-sm text-slate-500">Quantity: {{ $detail->quantity }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-slate-900">Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</div>
                                <div class="text-xs text-slate-500">Rp {{ number_format($detail->price, 0, ',', '.') }} / item</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h2 class="font-bold text-slate-900">Shipping Details</h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Courier</div>
                            <div class="font-bold text-slate-900">{{ $transaction->courier }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Status</div>
                            <div class="font-bold text-slate-900">{{ ucfirst($transaction->shipping_status) }}</div>
                        </div>
                        
                        @if($transaction->tracking_number)
                        <div class="md:col-span-2 bg-indigo-50 border border-indigo-100 rounded-lg p-4">
                            <div class="text-xs text-indigo-500 uppercase tracking-wider mb-1 font-bold">Tracking Number (Resi)</div>
                            <div class="font-mono text-xl font-bold text-indigo-700 tracking-wider">{{ $transaction->tracking_number }}</div>
                            <p class="text-xs text-indigo-400 mt-2">Use this number to track your package on the {{ $transaction->courier }} website.</p>
                        </div>
                        @else
                        <div class="md:col-span-2">
                             <div class="text-xs text-gray-400 uppercase tracking-wider mb-1">Shipping Address</div>
                            <div class="font-medium text-slate-900">{{ Auth::user()->address ?? 'Address not recorded for this historical data' }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h2 class="font-bold text-slate-900">Payment Summary</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3 text-slate-600">
                            <span>Payment Status</span>
                            <span class="font-bold {{ $transaction->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($transaction->payment_status) }}</span>
                        </div>
                        <div class="border-t border-gray-100 my-4"></div>
                        <div class="flex justify-between items-center mb-2 text-slate-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($transaction->total_price - $transaction->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4 text-slate-600">
                            <span>Shipping Cost</span>
                            <span>Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                            <span class="font-bold text-lg text-slate-900">Total Paid</span>
                            <span class="font-bold text-xl text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>

                        @if($transaction->payment_status == 'unpaid')
                        <button id="pay-button" class="w-full mt-6 bg-indigo-600 text-white text-center py-4 rounded-xl font-bold hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                            Pay Now
                        </button>
                        
                        @if(!config('midtrans.is_production'))
                        <a href="{{ route('payment.check', ['transaction' => $transaction->code]) }}" class="block w-full mt-3 bg-gray-200 text-gray-700 text-center py-3 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                            Check Payment Status (Dev)
                        </a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($transaction->payment_status == 'unpaid')
    <!-- Midtrans Snap JS -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        fetch('{{ route('payment.pay', $transaction->code) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.error) {
                alert(data.error);
                return;
            }
            snap.pay(data.snap_token, {
              // Optional
              onSuccess: function(result){
                /* You may add your own implementation here */
                // alert("payment success!"); 
                window.location.href = "{{ route('orders.index') }}"; // Redirect to orders
              },
              onPending: function(result){
                /* You may add your own implementation here */
                // alert("wating your payment!"); 
                location.reload();
              },
              onError: function(result){
                /* You may add your own implementation here */
                alert("payment failed!"); 
                location.reload();
              },
              onClose: function(){
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
              }
            });
        });
      };
    </script>
@endif
@endsection
