<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }
}
