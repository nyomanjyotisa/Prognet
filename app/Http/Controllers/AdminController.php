<?php

namespace App\Http\Controllers;
use App\Admin;
use Illuminate\Http\Request;
use App\Transaction;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        return view('admin');
    }
    
    public function transaksi(){
        $transaksi = Transaction::all();
        return view('admin.transaksi', ['transaksi' => $transaksi]);
    }
}
