<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $categories = Category::with('product')->get();
        $products = Product::with('product_image','product_category_detail','category','discount')->get();
        return view('user.product', ['product' => $products, 'category' => $categories]);
    }
}
