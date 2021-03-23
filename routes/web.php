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
Route::post('/checkout', 'CheckoutController@index');
Route::get('/kota/{id}', 'CheckoutController@getCities');
Route::post('/ongkir', 'CheckoutController@submit');
Route::post('/beli', 'TransactionController@store');
Route::get('/transaksi/{id}', 'TransactionController@index');
Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
Route::view('/cart', 'user.cart');
Route::view('/transaksi', 'user.transaksi');
Route::view('/detailtransaksi', 'user.detailtransaksi');
Route::post('/show_categori', 'HomeUnauthController@show_kategori');
Route::get('/home', function () {
    return redirect('/');
});
Auth::routes();

Route::prefix('admin')->group(function(){
    Route::get('/', function () {
        return redirect('admin/dashboard');
    });
    Route::view('/dashboard', 'admin');
    Route::get('/transaksi', 'TransactionController@adminIndex');
});
