<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SliderController;
use App\Models\ItemCategory;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function ()  {
//     $sliders = Slider::where('isActive', true)->latest('created_at')->get();
//     $categories = ItemCategory::latest('created_at')->get();
//     return view('welcome', ['sliders' => $sliders, 'categories' => $categories]);
// })->name('welcome');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/carousel', function() {
    $sliders = Slider::latest('created_at')->where('isActive', true)->get();
    // dd($sliders[0]);
    return view('layout.carousel', ['sliders' => $sliders]);
});

Route::get('/admin', function () {
    $sliders = DB::table('sliders')->latest('created_at')->get();
    return view('admin/admin', ['sliders' => $sliders]);
})->name('admin');

// Route::get('/admin/slider', [SliderController::class,'index'])->name('slider.index');
// Route::get('/admin/slider/slider-create', [SliderController::class,'create'])->name('slider.create');
// Route::post('admin/slider', [SliderController::class,'store'])->name('slider.store');

Route::resource('/admin/slider', SliderController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'update',
    'destroy',
    'edit',
]);

Route::resource('item-category', ItemCategoryController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'destroy',
    'edit',
]);

Route::resource('item', ItemController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'destroy',
    'edit',
]);

