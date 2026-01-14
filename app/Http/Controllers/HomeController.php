<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $sliders = Slider::where('isActive', true)->latest('created_at')->get();
        $categories = ItemCategory::with('items')->latest('created_at')->get();
        // dd($categories);
        return view('welcome', ['sliders' => $sliders, 'categories' => $categories]);
    }

}
