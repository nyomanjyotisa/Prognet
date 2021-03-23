<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\Product_Review;
use App\Response;
use App\User;
use App\Admin;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;

class TransactionDetailController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:admin']);
        $this->middleware(['auth:web']);
    }

    public function index($id){
        $transaksi = Transaction::with(['user','transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        $review = Product_Review::where('user_id', '=', $transaksi->user_id)->get();

        if($transaksi->user_id != Auth::user()->id || is_null(Auth::user())){
            return abort(404);
        }else{
            return view('user.detailtransaksi',['transaksi' => $transaksi, 'review' => $review]);
        }
    }

    public function membatalkanPesanan(Request $request){
        $transaksi = Transaction::with('transaction_detail')->find($request->id);
        $user = User::find($transaksi->user_id);
        $user->notify(new UserNotification("<a href ='/transaksi/detail/".$transaksi->id."'>Status Transaksimu dengan id ".$transaksi->id." telah diupdate</a>"));
        if($request->status == 1){
            $transaksi->status = 'canceled';
            $transaksi->save();
            return redirect('/transaksi/detail/'.$request->id);
        }elseif($request->status == 3){
            $transaksi->status = 'verified';
            $transaksi->save();

            // dd($transaksi->transaction_detail);
            foreach($transaksi->transaction_detail as $item){
                $produk = Product::find($item->product_id);
                // dd($produk);
                $produk->stock = $produk->stock - $item->qty;
                // dd($produk->stock);
                $produk->save();
            }

            return redirect('admin/transaksi/detail/'.$request->id);
        }elseif($request->status == 2){
            $transaksi->status = 'success';
            $transaksi->save();
            return redirect('/transaksi/detail/'.$request->id);
        }else{
            $transaksi->status = 'delivered';
            $transaksi->save();
            return redirect('admin/transaksi/detail/'.$request->id);
        }
    }

    public function uploadProof(Request $request){
        $transaksi = Transaction::find($request->id);

        $file = $request->file('file');
        $path = 'proof_payment';
        $nama_file = time()."_".$file->getClientOriginalName();
        $file->move($path,$nama_file);

        $transaksi->proof_of_payment = $nama_file;
        $transaksi->save();
        $admin = Admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/transaksi/detail/".$transaksi->id."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Bukti Bayar Diupload".
                  "</p>".
                "</div>".
              "</a>";
        $admin->notify(new AdminNotification($notif));

        return redirect('/transaksi/detail/'.$request->id);
    }

    public function adminIndex($id){
        $transaksi = Transaction::with(['transaction_detail' => function($q){
            $q->with(['product' => function($qq){
                $qq->with('product_image');
            }]);
        }, 'courier'])->find($id);

        if(is_null(Auth::guard('admin')->user())){
            return abort(404);
        }else{
            return view('product.admintransaksidetail',['transaksi' => $transaksi]);
        }
    }
}
