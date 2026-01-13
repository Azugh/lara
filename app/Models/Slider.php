<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{

    use HasFactory;
    public $fillable = ['title', 'content', 'btn_text', 'image', 'isActive'];

//    public function getImageUrlAttribute()
//    {
//        if (!$this->image) {
//            return null;
//        }
//
//        return Storage::url($this->image);
//    }
}
