<?php

namespace App\Http\Controllers\Admin;


use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with('photos', 'category', 'subCategory')->paginate(10);
        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();

        $subCategories = SubCategory::all();

        return view('admin.products.create', compact('categories', 'subCategories'));
    }

    public function store(CreateProductRequest $request)
    {
        // dd($request->all());

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'price' => $request->price,
            'is_new' => $request->is_new,
            'on_sale' => $request->on_sale,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,

            'slug' => Str::slug($request->name),
        ]);

        foreach ($request->images as $photo) {
            // Generate a random name for the image
            $name = Str::random(14);
            $extension = $photo->getClientOriginalExtension();

            // Store the image in the 'public' disk
            $path = $photo->storeAs("products/{$product->id}", "{$name}.{$extension}", 'public');

            // Create a photo record for the uploaded image
            Photo::create([
                'images' => $path,
                'product_id' => $product->id,
            ]);
        }

        $attributeValues = $request->attribute_value;

        $product->attributes()->createMany(
            collect($request->attribute_name)
                ->map(function ($name, $index) use ($attributeValues) {
                    return [
                        'attribute_name' => $name,
                        'attribute_value' => $attributeValues[$index],
                    ];
                })
        );
        return redirect()->route('products.index')->with('success', "$request->name added successfully.");
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        $subCategories = SubCategory::all();

        $attributes = $product->attributes()->get();

        return view('admin.products.create', compact('product', 'categories', 'subCategories', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $data = $request->only(['name', 'code', 'description', 'price', 'category_id', 'sub_category_id', 'quantity', 'meta_description', 'meta_keywords', 'is_new', 'on_sale']);

        $product->update($data);
        if ($request->hasFile('images')) {

            // Loop through the images and store them
            foreach ($request->images as $photo) {
                // Generate a random name for the image
                $name = Str::random(14);
                $extension = $photo->getClientOriginalExtension();

                // Store the image in the 'public' disk
                $path = $photo->storeAs("products/{$product->name}", "{$name}.{$extension}", 'public');

                // Create a photo record for each uploaded image
                Photo::create([
                    'images' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

        $attributeValues = $request->attribute_value;

        $product->attributes()->createMany(
            collect($request->attribute_name)
                ->map(function ($name, $index) use ($attributeValues) {
                    return [
                        'attribute_name' => $name,
                        'attribute_value' => $attributeValues[$index],
                    ];
                })
        );

        session()->flash('success', "$product->name updated successfully.");

        return redirect(route('products.index'));
    }

    public function destroy(Product $product)
    {
        // delete all product images
        $allImages = $product->photos;

        foreach ($allImages as $key => $img) {
            Storage::disk('public')->delete($img->images);
        }

        $product->photos()->delete();
        //delete product
        $product->attributes()->delete();

        $product->delete();

        session()->flash('success', "$product->name deleted successfully.");

        return redirect(route('products.index'));
    }

    public function destroyImage($id)
    {
        $image = Photo::find($id);

        Storage::disk('public')->delete($image->images);

        $image->delete();

        session()->flash('success', "Image deleted successfully.");

        return redirect()->back();
    }

    public function destroyAttribute($id)
    {
        $attribute = ProductAttribute::find($id);

        $attribute->delete();

        session()->flash('success', "Attribute deleted successfully.");

        return redirect()->back();
    }
}
