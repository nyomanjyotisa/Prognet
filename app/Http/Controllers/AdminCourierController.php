<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;
use Redirect;


class AdminCourierController extends Controller
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
        $couriers['couriers'] = Courier::orderby('id','desc')->paginate(5);
        return view('courier.courierlist', $couriers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courier.couriercreate');
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
        ];

        $this->validate($request,[
            'courier' => 'required|unique:couriers|max:100',
        ],$messages);

        $couriers = new Courier;
        $couriers->courier = $request->courier;
        $couriers->save();
        return Redirect::to('couriers')->with(['success' => 'Berhasil Menambah Kurir']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['courier'] = Courier::where($where)->first();
        return view('courier.courieredit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        ];

        $this->validate($request,[
            'courier' => 'required|unique:couriers|max:100',
        ],$messages);

        $update = [
            'courier' => $request->courier,
        ];
        Courier::where('id', $id)->update($update);
        return Redirect::to('couriers')->with(['success' => 'Berhasil Mengedit Kurir']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Courier::where('id',$id)->delete();
        return Redirect::to('couriers')->with('error','Berhasil Menghapus Kurir');
    }
}
