<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['product_id', 'attribute_name', 'attribute_value'];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
