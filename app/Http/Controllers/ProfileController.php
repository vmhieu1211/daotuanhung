<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'DESC')->paginate(5);

        $recentlyViewed = Product::inRandomOrder()->take(4)->get();

        return view('profile.index', compact('orders', 'recentlyViewed'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (auth()->id() != $order->user_id) {
            return back()->withErrors('You do not have acces to this!');
        }

        $products = $order->products()->get();

        $recentlyViewed = Product::inRandomOrder()->take(4)->get();

        return view('profile.show', compact('order', 'recentlyViewed', 'products'));
    }


    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        $input = $request->except(['password', 'password_confirmation']);

        if (! $request->filled('password')) {
            $user->fill($input)->save();
            return redirect()->back()->with('success', "Profile updated successfully.");
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();
        return redirect()->back()->with('success', "Profile updated successfully.");
    }
}
