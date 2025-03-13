<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index()
    {
        $systemInfo = SystemSetting::first();

        $discount = number_format((session()->get('coupon')['discount'] ?? 0), 3);
        $newSubtotal = number_format((Cart::subtotal() - $discount), 3);
        $newTotal = number_format($newSubtotal, 3);

        return view('checkout', compact('systemInfo'))->with([
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }

    // public function create()
    // {
    //     return 'Create payment working';
    // }

    public function store(Request $request)
    {
        $request->validate([
            'billing_fullname' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_province' => 'required',
            'billing_phone' => 'required',
            'notes' => 'max:255',
        ]);

        $order = Order::create([
            'order_number' => uniqid(),
            'user_id' => auth()->user()->id ?? null,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'billing_fullname' => $request->billing_fullname,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_province' => $request->billing_province,
            'billing_phone' => $request->billing_phone,
            'billing_email' => $request->billing_email,
            'notes' => $request->notes,
            'order_status_id' => $request->order_status_id ?? 1,
            'payment_method' => $request->payment_method,

        ]);

        // update user info if user is authenticated
        if (auth()->check()) {
            auth()->user()->update([
                'phone' => $request->billing_phone,
                'address' => $request->billing_address,
                'city' => $request->billing_phone,
                'province' => $request->billing_province,
                'notes' => $request->notes
            ]);
        }

        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }
        //clear cart contents
        Cart::destroy();
        return redirect()->route('my-orders.index')->with('success', "Thank you $request->billing_fullname, your order has been placed successfully!");
    }

    private function getNumbers()
    {
        $discount = number_format((session()->get('coupon')['discount'] ?? 0), 3);
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = number_format((Cart::subtotal() - $discount), 3);
        $newTotal = number_format($newSubtotal, 3);

        return collect([
            'code' => $code,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }
}
