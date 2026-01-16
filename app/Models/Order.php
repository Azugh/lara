<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = [
        'user_id',
        'total_quantity',
        'total_price',
        'order_items',
        'shipping_status',
        'payment_status',
        'shipping_address'
        ];

    protected $casts = [
        'shipping_address' => ShippingStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    public function cart(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function getCart() {
        return $this->cart;
    }
}
