<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{

    public function index()
    {
        $systemInfo = SystemSetting::first();

        $mightAlsoLike = Product::inRandomOrder()->take(4)->get();


        return view('wishlist', compact('mightAlsoLike', 'systemInfo'));
    }

    public function store(Request $request)
    {
        Cart::instance('wishlist')->add($request->id, $request->name, $request->quantity, $request->price, ['size' => $request->Size, 'color' => $request->Color])->associate('App\Models\Product');

        session()->flash('success', "$request->name added to your wishlist successfully!");

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        Cart::instance('wishlist')->update($id, $request->quantity);

        session()->flash('success', "Item updated successfully!");

        return redirect(route('wishlist.index'));
    }

    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id);

        session()->flash('success', "Item removed successfully!");

        return redirect()->back();
    }
}
