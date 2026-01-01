<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'courier' => 'required|string',
        ]);

        $cart = Session::get('cart', []);
        
        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Use transaction to ensure data integrity
        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'code' => 'TRX-' . mt_rand(10000, 99999) . '-' . time(),
                'total_price' => $total,
                'shipping_status' => 'pending',
                'payment_status' => 'unpaid',
                'courier' => $request->courier,
                // Shipping cost hardcoded for now or derived from courier logic later
                'shipping_cost' => 20000, 
            ]);

            foreach ($cart as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                
                // Optional: Decrement stock here if desired, 
                // or do it after payment confirmation.
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            // Clear cart
            Session::forget('cart');

            DB::commit();

            return redirect()->route('orders.show', $transaction->code)->with('success', 'Order placed successfully! Please complete your payment.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}
