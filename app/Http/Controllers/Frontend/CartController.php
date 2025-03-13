<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
 
class CartController extends Controller
{
    public function index()
    {
        // Cart::destroy();
        $systemInfo = SystemSetting::first();

        $mightAlsoLike = Product::inRandomOrder()->with('photos')->take(4)->get();

        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTotal = $newSubtotal;

        return view('cart', compact('mightAlsoLike', 'systemInfo'))->with([
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTotal' => $newTotal,
        ]);
    }

    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id  === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            session()->flash('success', "$request->name already in your cart!");

            return redirect(route('cart.index'));
        }

        Cart::add($request->id, $request->name, $request->quantity, $request->price, ['size' => $request->Size, 'color' => $request->Color])->associate('App\Models\Product');

        session()->flash('success', "$request->name added to your cart successfully!");

        return redirect(route('cart.index'));
    }

    public function update(Request $request, $id)
    {
        Cart::update($id, $request->quantity);
        return redirect()->route('cart.index')->with('success', "Item updated successfully!");
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->back()->with('success', "Item removed successfully!");
    }
}
