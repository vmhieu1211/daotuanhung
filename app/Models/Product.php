<?php

namespace App\Models;

use App\Models\Photo;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'sub_category_id', 'description', 'code', 'image', 'slug', 'quantity', 'price', 'on_sale', 'is_new'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function inStock()
    {
        return $this->quantity > 0;
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
