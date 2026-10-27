<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/products',[ProductsController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductsController::class,'create'])->name('products.create');
Route::get('/products/{products}/edit',[ProductsController::class,'edit'])->name('products.edit');
Route::put('/products/{products}',[ProductsController::class,'update'])->name('products.update');
Route::delete('/products/{products}',[ProductsController::class,'destroy'])->name('products.destroy');
Route::post('/products',[ProductsController::class,'store'])->name('products.store');

