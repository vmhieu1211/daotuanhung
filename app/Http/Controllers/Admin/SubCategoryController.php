<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
 

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::all();

        return view('admin.sub-categories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.sub-categories.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('subcategories.index')->with('success', 'Sub-Category created successfully!');
    }

    public function edit($slug)
    {
        $categories = Category::all();

        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        return view('admin.sub-categories.create', compact('subCategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, $slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        $slug = Str::slug($request->name);

        $subCategory->update([
            'slug' => $slug,
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'Sub-Category updated successfully!');
    }

    public function destroy($slug)
    {
        $subCategory = SubCategory::where('slug', $slug)->firstOrFail();

        if ($subCategory->products()->count() > 0) {
            return redirect()->route('subcategories.index')->with('error', 'Take a chill pill, this sub-category has some products!');
        }
        $subCategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Sub-Category deleted successfully!');
    }
}
