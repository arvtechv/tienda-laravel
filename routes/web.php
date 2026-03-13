<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'ProductController@index')->name('home');
Route::resource('products', 'ProductController');

// Rutas del carrito
Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('/add/{product}', 'CartController@add')->name('cart.add');
    Route::put('/update/{cartItem}', 'CartController@update')->name('cart.update');
    Route::delete('/remove/{cartItem}', 'CartController@remove')->name('cart.remove');
});
