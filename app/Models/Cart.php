<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
    
     public function order()
    {
        return $this->belongsTo(orders::class);

    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
