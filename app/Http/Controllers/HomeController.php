<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::count();
        $orders = Order::count();
        $products = Product::count();
        $messages = Contact::count();
        return view('home', compact('products', 'users', 'messages', 'orders'));
    }
}
