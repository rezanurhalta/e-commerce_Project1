<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->with('error', 'Your cart is empty!');
        }
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('customer.checkout', compact('cartItems', 'total'));
    }
    public function processCheckout(Request $request)
    {

        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:15',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,cash_on_delivery,e_wallet',
        ]);
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart')->with('error', 'Your cart is empty!');
        }
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        DB::beginTransaction();
        try {
            $order=Orders::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' .time(). '-' . Auth::id(),
                'total_amount' => $total,
                'shipping_name' => $request->input('shipping_name'),
                'shipping_address' => $request->input('shipping_address'),
                'shipping_phone' => $request->input('shipping_phone'),
                'payment_method' => $request->input('payment_method'),
                'payment_status' => 'unpaid',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
                $product = $item->product;
                $product->stock -= $item->quantity;
                $product->save();
            }
            Cart::where('user_id', Auth::id())->delete();
            DB::commit();
            return redirect()->route('customer.order.confirmation', $order->id)->with('success', 'Order placed successfully!');
            // return redirect()->route('customer.order.confirmation')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.checkout')->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
    public function confirmation($orderId)
    {
        $order = Orders::where('id', $orderId)->where('user_id', Auth::id())->with('orderItems.product')->firstOrFail();
        return view('customer.order-confirmation', compact('order'));

        
    }
    public function orders()
    {
        $orders = Orders::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('customer.orders', compact('orders'));
    }
    public function orderDetails($orderId)
    {
        $order = Orders::where('id', $orderId)->where('user_id', Auth::id())->with('orderItems.product')->firstOrFail();
        return view('customer.order-detail', compact('order'));
    }
}
