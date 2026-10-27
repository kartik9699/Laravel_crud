<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/products',[ProductsController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductsController::class,'create'])->name('products.create');
Route::get('/products/{product}/edit',[ProductsController::class,'edit'])->name('products.edit');
Route::post('/products',[ProductsController::class,'store'])->name('products.store');

