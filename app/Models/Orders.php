<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'shipping_name',
        'shipping_address',
        'shipping_phone',
        'payment_method',
        'payment_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        // return $this->belongsTo(OrderItem::class);
         return $this->hasMany(OrderItem::class, 'order_id');
    }
}