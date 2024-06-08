<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    use HasFactory;
    protected $table = 'cart_item';
    protected $guarded = [];
    
    public function Product_Details()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function total_price()
    {
       return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}
