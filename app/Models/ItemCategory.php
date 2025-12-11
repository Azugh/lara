<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    //
    public $fillable = ['category_name'];

    public function items() {
        return $this->belongsToMany(Item::class, 'item_item_category');
    }
}
