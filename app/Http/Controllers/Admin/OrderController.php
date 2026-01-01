<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Transaction::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Transaction $order)
    {
        $order->load(['details.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Transaction $order)
    {
        $request->validate([
            'shipping_status' => 'required|in:pending,shipping,delivered',
            'tracking_number' => 'nullable|string|max:255',
        ]);

        $originalStatus = $order->shipping_status;

        $order->update([
            'shipping_status' => $request->shipping_status,
            'tracking_number' => $request->tracking_number,
        ]);

        // Send email if status changed to shipping and wasn't shipping before
        if ($request->shipping_status == 'shipping' && $originalStatus != 'shipping') {
            Mail::to($order->user->email)->send(new OrderShipped($order));
        }

        return redirect()->back()->with('success', 'Order updated successfully.');
    }
    
    public function print(Transaction $order)
    {
         $order->load(['details.product', 'user']);
         return view('admin.orders.print', compact('order'));
    }
}
