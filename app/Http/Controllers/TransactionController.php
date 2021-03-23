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
// use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:admin']);
        $this->middleware(['auth:web']);
    }

    public function store(Request $request){
        $provinsi = Province::find($request->province);
        $kota = City::where('city_id','=',$request->regency)->first();
        $transaksi = new Transaction;
        date_default_timezone_set("Asia/Makassar");
        $transaksi->timeout = date('Y-m-d H:i:s', strtotime('+1 days'));
        $transaksi->address = $request->address;
        $transaksi->regency = $kota->title;
        $transaksi->province = $provinsi->title;
        $transaksi->total = $request->total;
        $transaksi->shipping_cost = $request->shipping_cost;
        $transaksi->sub_total = $request->sub_total;
        $transaksi->user_id = $request->user_id;
        $transaksi->courier_id = $request->courier;
        $transaksi->status = 'unverified';
        $transaksi->telp = $request->no_telp;
        $transaksi->save();
        $admin = Admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/transaksi/detail/".$transaksi->id."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Ada Transaksi Baru".
                  "</p>".
                "</div>".
              "</a>";
        // $admin->notify(new AdminNotification($notif));
        if($request->product_id != 0){
            $detail_transaksi = new Transaction_Detail;
            $detail_transaksi->transaction_id = $transaksi->id;
            $detail_transaksi->product_id = $request->product_id;
            $detail_transaksi->qty = $request->qty;
            $produk = Product::with('discount')->find($request->product_id);
            if($produk->discount->count()){
                foreach($produk->discount as $diskon){
                    if($diskon->end > date('Y-m-d')){
                        $detail_transaksi->discount = $diskon->percentage;
                    }else{
                        $detail_transaksi->discount = 0;
                    }
                }
            }else{
                $detail_transaksi->discount = 0;
            }
            $detail_transaksi->selling_price = $produk->price;
            $detail_transaksi->save();
        }else{
            $cart = Cart::with(['product' => function($q){
                $q->with('product_image','discount');
            }])->where('user_id', '=', $request->user_id)->where('status', '=', 'notyet')->get();
    
            foreach($cart as $item){
                $detail_transaksi = new Transaction_Detail;
                $detail_transaksi->transaction_id = $transaksi->id;
                $detail_transaksi->product_id = $item->product->id;
                $detail_transaksi->qty = $item->qty;
                if($item->product->discount->count()){
                    foreach($item->product->discount as $diskon){
                        if($diskon->end > date('Y-m-d')){
                            $detail_transaksi->discount = $diskon->percentage;
                        }else{
                            $detail_transaksi->discount = 0;
                        }
                    }
                }else{
                    $detail_transaksi->discount = 0;
                }
                $detail_transaksi->selling_price = $item->product->price;
                $detail_transaksi->save();
    
                $item->status = 'checkedout';
                $item->save();
            }
        }

        return redirect('/transaksi/'.$request->user_id);
    }

    public function index($id){
        if(is_null(Auth::user())){
            return redirect('/login');
        }elseif(Auth::user()->id != $id){
            return abort(404);
        }else{
            $transaksi = Transaction::orderBy('id', 'DESC')->where('user_id','=',$id)->get();
            return view('user.transaksi', ['transaksi' => $transaksi]);
        }
    }

    public function adminIndex(){
        // if(is_null(Auth::guard('admin')->user())){
        //     return redirect('/admin/login');
        // }else{
            $transaksi = Transaction::all();
            return view('product.admintransaksi', ['transaksi' => $transaksi]);
        // }
    }

    public function sort(Request $request){
        if($request->status == 'waiting'){
            $transaksi = Transaction::where('status','=','unverified')->whereNotNull('proof_of_payment')->get();
        }elseif($request->status == 'all'){
            $transaksi = Transaction::all();
        }else{
            $transaksi = Transaction::where('status', '=', $request->status)->get();
        }

        $hasil = view('product.adminfilter', ['transaksi' => $transaksi])->render();

        return response()->json(['success' => 'berhasil', 'hasil'=>$hasil]);
    }

    public function filterBulan(Request $request){
        $transaksi = transaction::whereMonth('created_at','=', $request->bulan)->whereYear('created_at','=', $request->tahun)->get();
        $status = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi->count()];
        $status['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,1);
        $status['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,1);
        $status['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,1);
        $status['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,1);
        $status['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,1);
        $status['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,1);

        foreach($transaksi as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status['harga'] = $status['harga'] + $item->total;
            }
        }

        return response()->json(['success' => 'berhasil', 'data' => $status]);
    }

    public function filterTahun(Request $request){
        $transaksi_bulan = transaction::whereMonth('created_at','=', $request->bulan)->whereYear('created_at','=', $request->tahun)->get();
        $status_bulan = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi_bulan->count()];
        $status_bulan['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,1);
        $status_bulan['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,1);
        $status_bulan['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,1);
        $status_bulan['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,1);
        $status_bulan['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,1);
        $status_bulan['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,1);

        foreach($transaksi_bulan as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status_bulan['harga'] = $status_bulan['harga'] + $item->total;
            }
        }

        $transaksi = transaction::whereYear('created_at','=', $request->tahun)->get();
        $status = ['unverified' => 0,'expired' => 0, 'canceled' => 0, 'verified' => 0, 'delivered' => 0, 'success' => 0, 'harga' => 0, 'total' => $transaksi->count()];
        $status['unverified'] = $this->findCountStatus('unverified',$request->bulan,$request->tahun,2);
        $status['expired'] = $this->findCountStatus('expired',$request->bulan,$request->tahun,2);
        $status['canceled'] = $this->findCountStatus('canceled',$request->bulan,$request->tahun,2);
        $status['verified'] = $this->findCountStatus('verified',$request->bulan,$request->tahun,2);
        $status['delivered'] = $this->findCountStatus('delivered',$request->bulan,$request->tahun,2);
        $status['success'] = $this->findCountStatus('success',$request->bulan,$request->tahun,2);

        foreach($transaksi as $item){
            if($item->status == 'verified' || $item->status == 'delivered' || $item->status == 'success'){
                $status['harga'] = $status['harga'] + $item->total;
            }
        }

        for($i = 1;$i<=12;$i++){
            $tahun[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->count();
        }

        return response()->json(['success' => 'berhasil', 'data' => $status, 'data_bulan' =>$status_bulan, 'tahun' => $tahun]);
    }



    public function findCountStatus($status, $bulan, $tahun, $cek)
    {
        if($cek == 1){
            $count = transaction::whereMonth('created_at','=', $bulan)->whereYear('created_at','=', $tahun)->where('status','=',$status)->count();
        }else{
            $count = transaction::whereYear('created_at','=', $tahun)->where('status','=',$status)->count();
        }
        return $count;
    }

    public function grafik(Request $request){
        if($request->status == 'all'){
            for($i = 1;$i<=12;$i++){
                $grafik[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->count();
            }
        }else{
            for($i = 1;$i<=12;$i++){
                $grafik[$i] = transaction::whereMonth('created_at','=', $i)->whereYear('created_at','=', $request->tahun)->where('status', '=', $request->status)->count();
            }
        }   
        return response()->json(['success' => 'berhasil', 'grafik' => $grafik]);
    }
}
