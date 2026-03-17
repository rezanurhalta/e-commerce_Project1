<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;
use App\Models\Product;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function products()
    {
        $products = Product::paginate(10);
        return view('customer.products', compact('products'));
    }

    public function orders()
    {
        // mengambil semua order milik user yang sedang login
        $orders = Orders::where('user_id', Auth::id())->latest()->get();

        // kirim data orders ke view
        return view('customer.orders', compact('orders'));
    }
    public function show($id)
{
    $order = Orders::with('orderItems.product')
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    return view('customer.order-detail', compact('order'));
}
}