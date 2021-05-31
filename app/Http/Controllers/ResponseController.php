<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\response as respon;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Notifications\UserNotification;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        $respon = new respon;
        $respon->review_id = $request->review_id;
        $respon->admin_id = $request->admin_id;
        $respon->content = $request->content;
        $respon->save();
        
        $review = DB::table('product_reviews')->select('product_reviews.*')->where('product_reviews.id', '=', $request->review_id)->first();
        $product = Product::find($review->product_id);
        $user = User::find($review->user_id);
        $user->notify(new UserNotification("<a href ='/product/".$review->product_id."'>Reviewmu di produk ".$product->product_name." telah direspon oleh admin</a>"));
        
        return redirect()->back()->with(['terkirim'=>'Balasan Terkirim']);
    }
}
