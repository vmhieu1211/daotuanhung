<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $slides = Slide::all();
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')
            ->with('category', 'photos')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('code', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            })
            ->paginate(8);
        return view('welcome', compact('products', 'categories', 'slides', 'query'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('photos', 'attributes')->firstOrFail();

        $singleImage = $product->photos()->get()->first();

        $relatedProducts = $product->category->products()->with('photos')->inRandomOrder()->take(5)->get();

        $systemName = SystemSetting::first();

        $color = $product->attributes()->where('attribute_name', 'Color')->get();
        $sizes = $product->attributes()->where('attribute_name', 'Size')->get();
        $pieces = $product->attributes()->where('attribute_name', 'Pieces')->first();

        return view('product.show', compact('product', 'relatedProducts', 'singleImage', 'systemName', 'color', 'sizes', 'pieces'));
    }

    public function contact()
    {
        $info = SystemSetting::first();

        $products = Product::orderBy('id', 'DESC')->with('photos')->take(4)->get();

        return view('contact', compact('info', 'products'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Save contact info
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // flash session & redirect
        session()->flash('success', "Hey $request->name, thanks for reaching out we will get back to you withinn 24 hours");

        return redirect()->back();
    }

    // display all categories and products
    public function categories()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $category = Category::with('subcategories')->get();

        $systemInfo = SystemSetting::first();

        return view('categories', compact('products', 'category', 'systemInfo'));
    }

    // diplay a single category and its products
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('category', compact('category', 'categories', 'products'));
    }

    // diplay a single subcategory and its products
    public function subcategory($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $products = $subCategory->products()->orderBy('created_at', 'DESC')->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('sub-category', compact('products', 'categories', 'subCategory'));
    }

    // return products on sale
    public function onSale()
    {
        $products = Product::where('on_sale', 1)->with('photos')->paginate(12);

        $categories = Category::with('subcategories')->get();

        return view('sale', compact('categories', 'products'));
    }

    // terms and contions
    // public function terms()
    // {
    //     $terms = Terms::firstOrFail();

    //     return view('terms', compact('terms'));
    // }

    // // return privacy privacy
    // public function privacy()
    // {
    //     $policy = PrivacyPolicy::firstOrFail();

    //     return view('privacy', compact('policy'));
    // }

    // return privacy privacy
    // public function aboutUs()
    // {
    //     $about = About::firstOrFail();

    //     return view('about-us', compact('about'));
    // }
}
