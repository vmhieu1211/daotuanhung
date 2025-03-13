<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $data = [
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
        ];


        Coupon::create($data);

        return redirect()->route('coupon.index')->with('success', 'Coupon added successfully');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $data = [
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
        ];
        $coupon->update($data);

        return redirect()->route('coupon.index')->with('success', 'Coupon updated succesfuly');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')->with('success', 'Coupon deleted succesfuly');
    }
}
