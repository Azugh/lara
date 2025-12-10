<?php

use App\Http\Controllers\SliderController;
// use App\Models\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function ()  {
    $sliders = Slider::where('isActive', true)->latest('created_at')->get();
    return view('layout.index', ['sliders' => $sliders]);
});

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
