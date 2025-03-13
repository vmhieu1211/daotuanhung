<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderStatus;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        foreach ($orders as $order) {
            $order->formatted_created_at = $order->created_at->format('d-m-Y');
        }
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        $statuses = OrderStatus::all();
        $products = $order->products()->get();

        return view('admin.orders.show', compact('order', 'products', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        $order->update([
            'order_status_id' => $request->order_status_id,
        ]);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}
