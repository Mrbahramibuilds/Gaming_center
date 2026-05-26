<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard',[ShopController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('post',PostController::class);
Route::middleware('admin.email')->group(function(){

Route::get('/admin/list_products',[ProductsController::class,'list_products'])->name('list_products');
Route::get('/admin/add_product',[ProductsController::class,'add_product'])->name('add_product');
Route::post('/admin/add_product',[ProductsController::class,'stor_product'])->name('products.store');
Route::delete('/admin/add_product/{id}',[ProductsController::class,'drop_products'])->name('delete_product');
Route::get('/admin/list_products/{product}/edit',[ProductsController::class, 'form_edit_product'])->name('form_edit_product');
Route::patch('/admin/list_products/{product}/edit',[ProductsController::class,'update_product'])->name('update_product');

});

Route::middleware('auth')->group(function () {
// user info section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// order section
    Route::get('dashboard/list_orders',[OrderController::class,'show_order'])->name('list_orders');
    Route::post('/dashboard/{product}',[OrderController::class,'add_order'])->middleware(['auth'])->name('add_order');
    // Route::post('/list_products/{product}',[OrderController::class,'add_order'])->name('add_order')->middleware(['auth']);
    Route::delete('/dashboard/list_orders/remove/{product}',[OrderController::class,'delete_product_in_order'])->name('delete_product_in_order');
});

require __DIR__.'/auth.php';
