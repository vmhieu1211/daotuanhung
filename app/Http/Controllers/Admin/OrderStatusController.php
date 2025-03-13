<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderStatus;
 use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStatusRequest;
 
class OrderStatusController extends Controller
{
    public function index()
    {
        $orderStatuses = OrderStatus::all();
        return view('admin.order-statuses.index', compact('orderStatuses'));
    }

    public function create()
    {
        return view('admin.order-statuses.create');
    }

    public function store(OrderStatusRequest $request)
    {
        OrderStatus::create([
            'name' => $request->input('name'),
            'identify_name' => $request->input('identify_name')
        ]);
        return redirect()->route('order-statuses.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $orderStatus = OrderStatus::findOrFail($id);
        return view('admin.order-statuses.edit', compact('orderStatus'));
    }

    public function update(OrderStatusRequest $request, OrderStatus $orderStatus)
    {
        $orderStatus->update([
            'name' => $request->name,
            'identify_name' => $request->identify_name
        ]);
        return redirect()->route('order-statuses.index')->with('success', 'Order Status updated successfully');
    }

    public function destroy(OrderStatus $orderStatus)
    {
        $orderStatus->delete();
        return redirect()->route('order-statuses.index')->with('success', 'Order Status deleted succesfuly');
    }
}
