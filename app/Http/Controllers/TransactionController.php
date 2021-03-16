<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Transaction_Detail;
use App\Province;
use App\City;
use App\Cart;
use App\Product;
use App\Admin;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    
    public function adminIndex(){
        // if(is_null(Auth::guard('admin')->user())){
        //     return redirect('/admin/login');
        // }else{
            $transaksi = Transaction::all();
            return view('admin.transaksi', ['transaksi' => $transaksi]);
        // }
    }

    
}
