<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    private mixed $price;
    private mixed $quanitity;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
        'item_name',
        'item_description',
        'item_image',
    ];


    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    protected static function booted(): void {

        static::created(function($orderItem) {
            if($orderItem->item) {
                $orderItem->item_name = $orderItem->item->name;
                $orderItem->item_description = $orderItem->item->description;
                $orderItem->item_image = $orderItem->item->image;
                $orderItem->price = $orderItem->item->price;
                $orderItem->quantity = $orderItem->item->quantity;
            }
        });
    }

    public function getTotalPrice() {
        return $this->price * $this->quanitity;
    }
}
