<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('customer.cart', compact('cartItems', 'total'));
    }
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }
        return redirect()->route('customer.cart')->with('success', 'Product added to cart!');
    }
    public function update(Request $request, $cartId)
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->quantity = $request->input('quantity', $cartItem->quantity);
        $cartItem->save();

        return redirect()->route('customer.cart')->with('success', 'Cart updated successfully!');
    }
    // public function remove($cartId)
    // {
    //    $cartItem = Cart::where('id', $cartId)
    //         ->where('user_id', Auth::id())
    //         ->delete();

    //     $cartItem->delete();

    //    return redirect()->route('customer.cart')->with('success', 'Item removed from cart!');
    // }
    public function remove($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();

        return redirect()->back()->with('success', 'Item removed from cart');
    }
}
