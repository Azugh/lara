<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('cartItem')->prefix('cart-item')->group(function () {
        Route::post('/{item}', [CartItemController::class, 'addItemToCart'])->name('cart-item.add');
        Route::post('{id}/update-quantity', [CartItemController::class, 'updateItemCartQuantity'])->name('cart-item.update-quantity');
        Route::delete('cart-item/{id}', [CartItemController::class, 'removeItemFromCart'])->name('cart-item.remove');
    });

    Route::prefix('cart')->group(function () {
        Route::delete('cart/{id}', [CartController::class, 'removeAllItemsFromCart'])->name('cart.delete');
        Route::get('/{id}', [CartController::class, 'show'])->name('cart.show');
        Route::get('{id}/partial', [CartController::class, 'partial'])->name('cart.partial');
    });

    Route::prefix('order')->group(function () {
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/payment/{id}/confirm', [OrderController::class, 'paymentConfirm'])->name('order.payment.confirm');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

Route::group(['middleware' => ['manager']], function () {
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
        Route::put('/{id}/update-shipping-status', [OrderController::class, 'updateShippingStatus'])->name('order.update-shipping-status');

    });
});

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

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::put('/{id}', [UserController::class, 'makeManager'])->name('user.make-manager');
    });

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

Route::resource('register_request', RegisterController::class)->only([
    'create',
    'store'
]);
