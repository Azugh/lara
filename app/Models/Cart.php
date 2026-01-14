<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    //
    protected $fillable = ['user_id', 'total_price', 'total_quantity'];

    protected $casts = ['total_price' => 'decimal:2'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getUser() {
        return $this->user;
    }
//    public function items() {
//        return $this->belongsToMany(Item::class, 'cart_items')
//            ->withPivot('quantity', 'price');
//    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function totalPrice() {
        $totalPrice = $this->cartItems()->sum(DB::raw('quantity * price'));
        $totalQuantity = $this->cartItems()->sum(DB::raw('quantity'));

        $this->update(['total_price' => $totalPrice, 'total_quantity' => $totalQuantity]);
    }

}
