<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeUnauthController@index');
Route::get('/product/{id}', 'HomeUnauthController@show');
Route::view('/checkout', 'user.checkout');
Route::view('/cart', 'user.cart');
Route::post('/show_categori', 'HomeController@show_kategori');

Route::prefix('admin')->group(function(){
    Route::view('/', 'admin');
    Route::view('/transaksi', 'admin.transaksi');
});
