<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\Auth\AuthenticatedSessionController;
use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SliderController;
use \App\Http\Controllers\ItemCategoryController;
use \App\Models\Slider;
use \Illuminate\Support\Facades\DB;
use \App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/carousel', function () {
    $sliders = Slider::where('isActive', true)
        ->latest('created_at')
        ->get();

    return view('layout.carousel', compact('sliders'));
});

Route::get('email-is-verified', function () {
    return view('components.email-is-verified');
})->name('email-is-verified');

Route::post('login', [AuthenticatedSessionController::class, 'loginByEmail'])
    ->name('email.login');

require __DIR__ . '/auth.php';

Route::resource('item', ItemController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

//    Route::get('cart', [CartController::class, 'index'])->name('cart.index');

    Route::prefix('cart')->group(function () {
       Route::post('/{item}', [CartController::class, 'addItemToCart'])->name('cart.add');
//       Route::post('/{item}', [CartController::class, 'removeItemFromCart'])->name('cart.remove');
       Route::delete('/', [CartController::class, 'destroy'])->name('cart.destroy');
       Route::get('/{id}', [CartController::class, 'show'])->name('cart.show');
    });
});

Route::post('cart/{id}', [CartController::class, 'increaseItemCartQuantity'])->name('cart.increase');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $sliders = DB::table('sliders')->latest('created_at')->get();
        return view('admin.admin');
    })->name('dashboard');

    Route::resource('register_request', RegisterController::class)
        ->only(['index']);

    Route::post('register_request/{id}', [RegisterController::class, 'verifyUser'])
        ->middleware('throttle:6,1')
        ->name('register_request.verify');

    Route::resource('slider', SliderController::class)
        ->except(['edit', 'update']);

    Route::resource('item', ItemController::class)
        ->only(['create', 'store', 'edit', 'destroy'])
        ->names('item');

    Route::resource('item-category', ItemCategoryController::class)
        ->except(['update']);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

});

Route::resource('item', ItemController::class)->only(['index', 'show'])->names('item');
//Route::get('sign-up', function() {
//    return view('auth.signup');
//})->name('sign-up');

Route::resource('register_request', RegisterController::class)->only([
    'create',
]);


