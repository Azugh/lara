<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    //
    protected $fillable = ['user_id', 'total_price', 'total_quantity',
        'session_id',
        'quantity'
    ];

    protected $casts = ['total_price' => 'decimal:2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function items() {
//        return $this->belongsToMany(Item::class, 'cart_items')
//            ->withPivot('quantity', 'price');
//    }

    public function totalPrice()
    {

        $totalPrice = $this->cartItems()->with('item')->get()->sum(
            function ($cartItem) {
                return $cartItem->item->price * $cartItem->quantity;
            }
        );
        $totalQuantity = $this->cartItems()->get()->sum(
            function ($cartItem) {
                return $cartItem->quantity;
            }
        );

        $this->update(['total_price' => $totalPrice, 'total_quantity' => $totalQuantity]);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

}
