<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    /**
     * @var int|mixed
     */
    protected $fillable = ['name', 'cart_id', 'item_id', 'quantity', 'price'];

    protected $casts = ['price' => 'decimal:2'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }


    public function getSubtotal()
    {
        return $this['price'] * $this['quantity'];
    }
}
