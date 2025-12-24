<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/carousel', function () {
    $sliders = \App\Models\Slider::latest('created_at')->where('isActive', true)->get();
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

Route::resource('/admin/slider', \App\Http\Controllers\SliderController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'update',
    'destroy',
    'edit',
]);

Route::resource('/admin/register_request', \App\Http\Controllers\RegisterController::class)->only([
    'index',
]);

Route::post('/admin/register_request/{id}', [\App\Http\Controllers\RegisterController::class, 'verifyUser'])->name('verifyUser');

Route::resource('item-category', \App\Http\Controllers\ItemCategoryController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'destroy',
    'edit',
]);

Route::resource('item', \App\Http\Controllers\ItemController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'destroy',
    'edit',
]);

//Route::get('sign-up', function() {
//    return view('auth.signup');
//})->name('sign-up');

//Route::resource('register_request', \App\Http\Controllers\RegisterController::class)->only([
//    'index',
//    'create',
//    'store',
//    'destroy',
//]);
