<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $productCount = Product::count();
        $ordercount = Orders::count();
        $revenue = Orders::where('status', '!=', 'cancelled')->sum('total_amount');
        return view('admin.dashboard', compact('productCount', 'ordercount', 'revenue'));
    }
    public function salesReport(Request $request)
    {
        $query = Orders::query();
        $period = $request->input('period', 'all');
        $date = $request->input('date', now()->format('Y-m-d'));
        $title = 'Semua Sales Report';

        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', $date);
                $title = 'Harian Sales Report (' . Carbon::parse($date)->format('d M Y') . ')';
                break;

            case 'weekly':
                $startOfWeek = Carbon::parse($date)->startOfWeek();
                $endOfWeek = Carbon::parse($date)->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $title = 'Mingguan Sales Report (' . $startOfWeek->format('d M Y') . ' - ' . $endOfWeek->format('d M Y') . ')';
                break;

            case 'monthly':
                $query->whereMonth('created_at', Carbon::parse($date)->month)
                    ->whereYear('created_at', Carbon::parse($date)->year);
                $title = 'Bulanan Sales Report (' . Carbon::parse($date)->format('F Y') . ')';
                break;

            case 'yearly':
                $query->whereYear('created_at', Carbon::parse($date)->year);
                $title = 'Tahunan Sales Report (' . Carbon::parse($date)->format('Y') . ')';
                break;
        }

        // ambil data setelah semua filter dan order
        $orders = $query->orderBy('created_at', 'desc')->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->where('status', '!=', 'cancelled')->sum('total_amount');
        $successfulOrders = $totalRevenue;

        return view('admin.sales.index', compact(
            'orders',
            'title',
            'totalOrders',
            'totalRevenue',
            'successfulOrders',
            'period',
            'date'
        ));
    }
    // public function salesReport(Request $request)
    // {
    //     $query = Orders::query();
    //     $period = $request->input('period', 'all');
    //     $date=$request->input('date',now()->format('Y-m-d'));

    //     switch ($period) {
    //         case 'daily':
    //             $query = Orders::whereDate('created_at', $date)->get();
    //             $title = 'harian Sales Report(' .Carbon::parse($date)->format('d M Y') .')';
    //             break;
    //         case 'weekly':
    //             $startOfWeek = Carbon::parse($date)->startOfWeek();
    //             $endOfWeek = Carbon::parse($date)->endOfWeek();
    //             $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
    //             $title = 'mingguan Sales Report(' . $startOfWeek->format('d M Y') .' - ' . $endOfWeek->format('d M Y') .')';
    //             break;
    //         case 'monthly':
    //             $query = Orders::whereMonth('created_at', Carbon::parse($date)->month)
    //                 ->whereYear('created_at', Carbon::parse($date)->year);
    //             $title = 'bulanan Sales Report(' . Carbon::parse($date)->format('F Y') .')';
    //             break;

    //         case 'yearly':
    //             $orders = Orders::whereYear('created_at', date('Y', strtotime($date)))->get();
    //             break;
    //         default:
    //             $title = 'Semua Sales Report';
    //             break;
    //     }

    //     $orders = $query->orderBy('created_at', 'desc')->get();
    //     $totalOrders = $orders->count();
    //     $totalRevenue = $orders->where('status', '!=', 'cancelled')->sum('total_amount');
    //     $successfulOrders = $orders->where('status','!=' ,'cancelled')->sum('total_amount');

    //     return view('admin.sales.index', compact('orders', 'title', 'totalOrders', 'totalRevenue', 'successfulOrders', 'period', 'date',));
    // }
    public function index()
    {
        $orders = Orders::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Orders::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Status order berhasil diupdate');
    }
}
