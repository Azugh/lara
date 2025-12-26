<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{

    use HasFactory;

    public $fillable = ['name', 'image'];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
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
