<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use PHPUnit\Metadata\Group;

Route::get('/', [ShopController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/dashboard',[ShopController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('post',PostController::class);
Route::middleware(['admin.email','auth'])->group(function(){

// products managment admin panel
Route::get('/admin/list_products',[ProductsController::class,'list_products'])->name('list_products');
Route::get('/admin/add_product',[ProductsController::class,'add_product'])->name('add_product');
Route::post('/admin/add_product',[ProductsController::class,'stor_product'])->name('products.store');
Route::delete('/admin/add_product/{id}',[ProductsController::class,'drop_products'])->name('delete_product');
Route::get('/admin/list_products/edit/{product}',[ProductsController::class, 'form_edit_product'])->name('form_edit_product');
Route::patch('/admin/list_products/edit/{product}',[ProductsController::class,'update_product'])->name('update_product');

// users managment admin panel
Route::get('/admin/list_users',[UserController::class,'list_users'])->name('list_users');
Route::get('/admin/add_user',[UserController::class,'add_user'])->name('add_user');
Route::post('/admin/add_user',[UserController::class,'user_store'])->name('user_store');
Route::get('/admin/edit_user/{user}',[UserController::class,'form_edit_user'])->name('form_edit_user');
Route::patch('/admin/edit_user/{user}',[UserController::class,'update_user'])->name('update_user');
Route::delete('/admin/edit_user/{user}',[UserController::class,'drop_user'])->name('delete_user');

// categories managment admin panel
Route::get('/admin/list_categories',[CategoryController::class,'list_categories'])->name('list_categories');
Route::get('/admin/add_category',[CategoryController::class,'add_category'])->name('add_category');
Route::post('/admin/add_category',[CategoryController::class,'category_store'])->name('category_store');
Route::get('/admin/edit_category/{category}',[CategoryController::class,'form_edit_category'])->name('form_edit_category');
Route::patch('/admin/edit_category/{category}',[CategoryController::class,'update_category'])->name('update_category');
Route::delete('/admin/edit_category/{category}',[CategoryController::class,'drop_category'])->name('delete_category');

// purcheses managment admin panel
Route::get('/admin/list_purcheses',[PurchaseController::class,'list_purches'])->name('list_purches');
Route::get('/admin/add_purches',[PurchaseController::class,'add_purchese'])->name('add_purches');
Route::post('/admin/add_purches',[PurchaseController::class,'purchese_store'])->name('purches_store');
Route::get('/admin/details_purches/{purchase}',[PurchaseController::class,'details_purchese'])->name('details_purches');
Route::delete('/admin/edit_purches/{purchase}',[PurchaseController::class,'drop_purches'])->name('delete_purches');
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
