<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{

    public $fillable = ['name', 'image'];

    public function categories() {
        return $this->belongsToMany(ItemCategory::class, 'item_item_category');
    }
    //

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return Storage::url($this->image);
    }
}
