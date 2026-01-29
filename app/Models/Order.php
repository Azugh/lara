<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\ShippingStatus;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'shipping_address',
        'payment_date'
    ];

    protected $casts = [
        'shipping_status' => ShippingStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    protected static function booted()
    {
        static::observe(OrderObserver::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser()
    {
        return $this->user;
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
