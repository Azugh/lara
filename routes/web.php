<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin/admin');
});


Route::resource('/admin', SliderController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'update',
    'destroy',
    'edit',
]);
