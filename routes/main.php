<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\pos\PosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(DashboardController::class)->group(function (){
    Route::get('/','dashboard')->name('dashboard');
});

Route::controller(ProductController::class)->prefix('product')->name('product.')->group(function (){
    Route::get('/index','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update/{id}','update')->name('update');
    Route::get('/delete/{id}','delete')->name('delete');
});

Route::controller(OrderController::class)->prefix('order')->name('order.')->group(function(){
    Route::get('/index','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/filter','filter')->name('filter');
});

Route::controller(PosController::class)->prefix('pos')->name('pos.')->group(function (){
    Route::get('/show','show')->name('show');
    Route::get('/add-to-cart','addProduct')->name('add.cart');
    Route::get('/get-cart-data','getCartData')->name('get.cart.data');
    Route::get('/delete-data','deleteData')->name('delete.data');
    Route::get('/change-quantity','changeQuantity')->name('change.quantity');
    Route::get('/empty-cart','emptyCart')->name('empty.cart');
    Route::get('product-search','searchProduct')->name('product.search');
});


