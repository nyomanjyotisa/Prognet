@extends('layouts.adminApp')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          	<strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
    	<button type="button" class="close" data-dismiss="alert">×</button> 
        	<strong>{{ $message }}</strong>
    </div>
@endif
<div class="table">
		<h2 class="card-title" align="center">List Trash Produk</h2>
		<br>
        <span>
        <button type="button" class="btn-sm btn-warning btn-icon-text" onclick="">
            <i class="mdi mdi-keyboard-backspace btn-icon-prepend fa fa-arrow-left"></i>     
            <a href="/admin/products" style="color: white;">Back</a>
        </button>
        <button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
            <i class="mdi mdi-file-restore btn-icon-prepend fa fa-undo"></i>     
            <a href="/admin/products-restore-all" style="color: white;"  onclick="return confirm('Apa yakin ingin mengembalikan semua data ini?')">Restore All</a>
        </button>
        <button type="button" class="btn-sm btn-danger btn-icon-text" onclick="">
            <i class="mdi mdi-delete-forever btn-icon-prepend fa fa-trash"></i>
            <a href="/admin/products-delete-all" style="color: white"  onclick="return confirm('Apa yakin ingin menghapus permanen semua data ini?')">Delete All</a>
        </button>
        </span>
        <div class="table-responsive">
          <table align="center" class="table table-hover" width="100%" cellspacing="0">
            <thead>
              <tr>
              <th scope="col">Nama Produk</th> 
              <th scope="col">Kategori</th>
              <th scope="col">Rating</th>
              <th scope="col">Stock</th>
              <th scope="col">Berat</th>
              <th scope="col">Harga</th>
              <th scope="col">Deskripsi Produk</th>     
              <th scope="col">Action</th>         
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
				<td>{{ $product->product_name }}</td>
				<td>
				@foreach($categories as $category)
					@if($product->id == $category->product_id)
					  <li>{{ $category->category_name }}</li>
					@endif
				@endforeach
				</td>
                <td>{{ $product->product_rate }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->weight }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    <a class="btn-sm btn-info fa fa-undo" href="/admin/products/restore/{{ $product->id }}"  onclick="return confirm('Apa yakin ingin mengembalikan data ini?')">Undo</a>
					          <a class="btn-sm btn-danger fa fa-trash" href="/admin/products/destroy/{{ $product->id }}"  onclick="return confirm('Apa yakin ingin menghapus permanen data ini?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $products->links() !!}
		</div>
</div>
@endsection