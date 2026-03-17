<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function index()
    {
      $orders = Orders::with('user')->orderBy('created_at', 'desc')->paginate(10);
      return view('admin.orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Orders::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function update(request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|in:paid,unpaid',
        ]);

        $order = Orders::findOrFail($id);
        $order->update ([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);
        return redirect()->route('admin.orders.index',$id)
            ->with('success', 'Order status updated successfully.');
    }
}

