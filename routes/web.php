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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeUnauthController@show');
Route::post('/checkout', 'CheckoutController@index');
Route::get('/kota/{id}', 'CheckoutController@getCities');
Route::post('/ongkir', 'CheckoutController@submit');
Route::post('/beli', 'TransactionController@store');
Route::get('/transaksi/{id}', 'TransactionController@index');
Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
Route::post('/transaksi/detail/status', 'TransactionDetailController@membatalkanPesanan');
Route::post('/transaksi/detail/proof', 'TransactionDetailController@uploadProof');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');
Route::get('/cart', 'CartController@show');
Route::post('/tambah_cart', 'CartController@store');
Route::post('/update_qty', 'CartController@update');
Route::post('/show_categori', 'HomeUnauthController@show_kategori');

Auth::routes();
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::put('/admin/transaksi/update/{transaksi:id}', [TransactionAdminController::class, 'update'])->name('update-transaksi');

Route::prefix('admin')->group(function(){
    Route::get('/', function () {
        return redirect('admin/dashboard');
    })->name('admin.dashboard');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('/transaksi', 'AdminController@transaksi');

    Route::post('/transaksi/sort', 'TransactionController@sort');
    Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
    Route::get('/marknotifadmin', 'AdminController@markReadAdmin');

    Route::get('/transaksi/detail/{id}','AdminDetailTransaksiController@index')->name('admin.detail_transaksi');

    Route::post('/transaksi/detail/status', 'AdminDetailTransaksiController@membatalkanPesanan');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout route
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Register routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    // Password reset routes
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');


});

Route::get('/marknotif', 'UsersController@marknotif');

Route::resource('response', 'ResponseController');
Route::post('/admin/transaksi/sort', 'TransactionController@sort');
Route::post('/report-bulan', 'TransactionController@filterBulan');
Route::post('/report-tahun', 'TransactionController@filterTahun');
Route::post('/grafik', 'TransactionController@grafik');
Route::post('/respon', 'ResponseController@store');

Route::post('/beli', 'TransactionController@store');
Route::get('/transaksi/{id}', 'TransactionController@index');
Route::get('/transaksi/detail/{id}', 'TransactionDetailController@index');
Route::post('/transaksi/detail/status', 'TransactionDetailController@membatalkanPesanan');
Route::post('/transaksi/detail/proof', 'TransactionDetailController@uploadProof');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');
Route::post('/transaksi/detail/review', 'ProductReviewController@store');