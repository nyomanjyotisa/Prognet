<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Discount;
use App\Product_Category_Detail;
use App\Product_image;
use App\Product_Review as Review;
use App\Response;
use Redirect;


class AdminProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        /*$data['products'] = Product::orderBy('id')->paginate(10);*/
        $products = DB::table('products')
        ->select('products.*')
        ->where('products.deleted_at','=', NULL)
        ->orderby('id','desc')->paginate(10);
        $categories = DB::table('product_categories')
                    ->join('product_category_details', 'product_categories.id', '=', 'product_category_details.category_id')
                    ->select('product_categories.*', 'product_category_details.*')
                    ->get();
        $discount = DB::table('discounts')
                    ->select('discounts.*')
                    ->get();
        return view('product.adminlist',compact('products','categories','discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        /*$categories = Category::get();*/
        return view('product.admincreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute Wajib Diisi',
            'max' => ':attribute Harus Diisi maksimal :max karakter',
            'min' => ':attribute Harus Diisi minimum :min karakter',
            'string' => ':attribute Hanya Diisi Huruf dan Angka',
            'confirmed' => ':attribute Konfirmasi Password Salah',
            'unique' => ':attribute sudah ada',
            'email' => 'attribute Format Email Salah',
        ];

        $this->validate($request,[
            'product_name' => 'required|unique:products|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ],$messages);

    	$product = new Product;
        
        $product->product_name = $request->product_name;
    	$product->price = $request->price;
    	$product->description = $request->description;
    	$product->product_rate = 0;
    	$product->stock = $request->stock;
    	$product->weight = $request->weight;
        $product->save();

        $datakategori = $request->category_id;
        foreach($datakategori as $kategori){
            $category = new Product_Category_Detail;
            $product_id = Product::orderBy('id', 'desc')->first()->id;
            $category->category_id = $kategori;
            $category->product_id = $product_id;
            $category->save();
        }

        $this->validate($request, [
            'files.*' => 'required',
        ]);

        $id = Product::orderBy('id', 'desc')->first()->id;
        if($id){
        $files = [];
        foreach ($request->file('files') as $file) {
            if($file->isValid()){
                $nama_image = time()."_".$file->getClientOriginalName();
                $folder = 'uploads/product_images';
                $file->move($folder,$nama_image);
                $files[] = [
                    'product_id' => $id,
                    'image_name' => $nama_image,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ];
            }
        }
        Product_image::insert($files);
    }
        return Redirect::to('products')->with(['success' => 'Berhasil Menambah Produk']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $where = array('products.id' => $id);
    	$products['products'] = DB::table('products')
            ->join('product_category_details', 'products.id','=','product_category_details.product_id')
            ->join('product_categories', 'product_categories.id','=','product_category_details.category_id')
            ->select('products.*','product_categories.category_name')
            ->where($where)->first();
        $image = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('product_images.*')
            ->where($where)->get();
        $categories = DB::table('product_categories')
            ->join('product_category_details', 'product_categories.id', '=', 'product_category_details.category_id')
            ->join('products', 'products.id', '=', 'product_category_details.product_id')
            ->select('product_categories.category_name')
            ->where('products.id', '=', $id)->get();
        $reviews = DB::table('product_reviews')->join('users', 'users.id', '=', 'product_reviews.user_id')
            ->select('product_reviews.*', 'users.name')->where('product_reviews.product_id', '=',$id)
            ->orderby('product_reviews.id', 'desc')->get();
        $responses = DB::table('response')->select('response.*')->get();
        return view('product.adminlistdetail', compact('products','reviews','responses', 'image','categories','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $categoryDetail = DB::table('product_category_details')
            ->select('category_id')
            ->where('product_id', '=', $id)->get();
        $products = Product::find($id);
        return view('product.adminedit', compact('category','categoryDetail', 'products', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute Wajib Diisi',
            'max' => ':attribute Harus Diisi maksimal :max karakter',
            'min' => ':attribute Harus Diisi minimum :min karakter',
            'string' => ':attribute Hanya Diisi Huruf dan Angka',
            'confirmed' => ':attribute Konfirmasi Password Salah',
            'unique' => ':attribute Username sudah ada',
            'email' => 'attribute Format Email Salah',
        ];

        $this->validate($request,[
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ],$messages);

        $update = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ];
        Product::where('id', $id)->update($update);

        Product_Category_Detail::where('product_id', '=', $id)->delete();
        $datakategori = $request->category_id;
        foreach($datakategori as $category){
            $categoryDetail = new Product_Category_Detail;
            $categoryDetail->product_id = $id;
            $categoryDetail->category_id = $category;
            $categoryDetail->save();
        }
        return Redirect::to('products')->with(['success' => 'Berhasil Mengedit Produk']);
    }

    public function soft_delete($id){
        $products = Product::find($id);
        $products->delete();
        return Redirect::to('products')->with(['error' => 'Berhasil Menghapus Produk']);
    }

    public function destroy($id){
        Product::where('id', $id)->delete();
        return Redirect::to('products');    
    }

    public function upload($id){
        $products = Product::find($id);
        return view('product.adminproductimage', compact('products', 'id'));
    }

    public function upload_image(Request $request, $id){
        
        $this->validate($request, [
            'files.*' => 'required',
        ]);

        $files = [];
        foreach ($request->file('files') as $file) {
            if($file->isValid()){
                $nama_image = time()."_".$file->getClientOriginalName();
                $folder = 'uploads/product_images';
                $file->move($folder,$nama_image);
                $files[] = [
                    'product_id' => $id,
                    'image_name' => $nama_image,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ];
            }
        }

        Product_image::insert($files);
        return Redirect::to('products')->with(['success' => 'Berhasil Menambahkan Foto']);
    }

    public function discount($id){
        $products = Product::find($id);
        return view('product.admincreatediscount', compact('products', 'id'));
    }

    public function add_discount(Request $request, $id){
        $messages = [
            'required' => ':attribute wajib diisi',
            'max' => ':attribute Harus Diisi maksimal :max karakter',
            'min' => ':attribute Harus Diisi minimum :min karakter',
            'string' => ':attribute Hanya Diisi Huruf dan Angka',
            'confirmed' => ':attribute Konfirmasi Password Salah',
            'unique' => ':attribute sudah ada',
        ];

        $this->validate($request,[
            'percentage' => 'required|numeric',
            'start' => 'required|date',
            'end' => 'required|date',
        ],$messages);

    	$discount = new Discount;
        $discount->percentage = $request->percentage;
        $discount->id_product = $id;
    	$discount->start = $request->start;
    	$discount->end = $request->end;
        $discount->save();
        
        return Redirect::to('/discounts/'.$id)
       ->with('success','Berhasil Menambah Data Diskon');
    }

    public function trash(){
        $products = DB::table('products')
            ->select('products.*')
            ->where('products.deleted_at','!=', NULL)
            ->orderby('id','desc')->paginate(10);
        $categories = DB::table('product_categories')
            ->join('product_category_details', 'product_categories.id', '=', 'product_category_details.category_id')
            ->select('product_categories.*', 'product_category_details.*')
            ->get();
        return view('product.admintrash', compact('products', 'categories'));
    }

    public function restore($id){
        $products = Product::onlyTrashed()->where('id',$id);
        $products->restore();
        return Redirect::to('products-trash')->with(['success' => 'Berhasil Mengembalikan Produk']);
    }

    public function restore_all(){
        $products = Product::onlyTrashed();
        $products->restore();
        return Redirect::to('products-trash')->with(['success' => 'Berhasil Mengembalikan Semua Produk']);   
    }

    public function delete($id){
        Product_Category_Detail::where('product_id',$id)->delete();
        Discount::where('id_product',$id)->delete();
        Product_image::where('product_id',$id)->delete();
        $products = Product::onlyTrashed()->where('id', $id);
        $products->forceDelete();
        return Redirect::to('products-trash')->with(['error' => 'Berhasil Menghapus Permanen Produk']);
    }

    public function delete_all($id){
        Product_Category_Detail::where('product_id',$id)->delete();
        Product_image::where('product_id',$id)->delete();
        $products = Product::onlyTrashed();
        $products->forceDelete();
        return Redirect::to('products-trash')->with(['error' => 'Berhasil Menghapus Permanen Semua Produk']);
    }

    public function hapus_review($id){
        $review = Review::find($id);
        $product_id = $review->product_id;
        $product_id = $review->product_id;
        $review->delete();

        $reviews = Review::where('product_id', '=', $product_id)->get();
        $meanRate = 0;
        $count = $reviews->count();

        foreach($reviews as $item){
            $meanRate = $meanRate+$item->rate;
        }
        if($count == 0){
            $meanRate = 0;
        }else{
            $meanRate = $meanRate / $count;
        }

        $product = Product::find($product_id);
        $product->product_rate = $meanRate;
        $product->save();

        return redirect('/products/'.$product_id.'#review');
    }
}