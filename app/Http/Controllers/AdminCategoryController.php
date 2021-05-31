<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product_Category_Detail;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class AdminCategoryController extends Controller
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
        $categories = Category::orderby('id','desc')->paginate(5);
        return view('category.listcategory', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.createcategory');
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
            'unique' => ':attribute Username sudah ada',
            'email' => 'attribute Format Email Salah',
        ];

        $this->validate($request,[
            'category_name' => 'required|unique:product_categories|max:100',
        ],$messages);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
        return Redirect::to('categories')->with(['success' => 'Berhasil Menambah Kategori']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['category'] = Category::where($where)->first();
        return view('category.editcategory', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
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
            'category_name' => 'required|unique:product_categories|max:100',
        ],$messages);

        $update = [
            'category_name' => $request->category_name,
        ];
        Category::where('id', $id)->update($update);
        return Redirect::to('categories')->with(['success' => 'Berhasil Mengedit Kategori']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return Redirect::to('categories');
    }

    public function soft_delete($id){
        $categories = Category::find($id);
        $categories->delete();
        return Redirect::to('categories')->with(['error' => 'Berhasil Menghapus Kategori']);
    }

    public function trash(){
        $categories = DB::table('product_categories')
        ->select('product_categories.*')
        ->where('deleted_at','!=',NULL)
        ->orderby('id','desc')
        ->paginate(5);
        return view('category.categorytrash', compact('categories'));
    }

    public function restore($id){
        $categories = Category::onlyTrashed()->where('id',$id);
        $categories->restore();
        return Redirect::to('categories-trash')->with(['success' => 'Berhasil Mengembalikan Kategori']);
    }

    public function restore_all(){
        $categories = Category::onlyTrashed();
        $categories->restore();
        return Redirect::to('categories-trash')->with(['success' => 'Berhasil Mengembalikan Semua Kategori']);   
    }

    public function delete($id){
        Product_Category_Detail::where('category_id',$id)->delete();
        $categories = Category::onlyTrashed()->where('id', $id);
        $categories->forceDelete();
        return Redirect::to('categories-trash')->with(['error' => 'Berhasil Menghapus Permanen Kategori']);
    }

    public function delete_all($id){
        Product_Category_Detail::where('product_id',$id)->delete();
        $categories = Category::onlyTrashed();
        $categories->forceDelete();
        return Redirect::to('categories-trash')->with(['error' => 'Berhasil Menghapus Permanen Semua Kategori']);
    }
}