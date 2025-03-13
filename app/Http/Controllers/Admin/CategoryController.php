<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('categories.index')->with('success', "Category, $request->name added successfully");
    }

    public function edit(Category $category)
    {
        return view('admin.categories.create', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $slug = Str::slug($request->name);

        $category->update([
            'name' => $request->name,
            'slug' => $slug
        ]);
        return redirect()->route('categories.index')->with('success', "Category $request->name updated successfully");;
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Take it easy, you cannot delete this category because it has some products');
        }
        $categoryName = $category->name;
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', "Category, $categoryName deleted successfully");
    }
}
