@extends('layouts.main')
@section('content')
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
            <a href="/products" style="color: white;">Back</a>
        </button>
        <button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
            <i class="mdi mdi-file-restore btn-icon-prepend fa fa-undo"></i>     
            <a href="/products-restore-all" style="color: white;"  onclick="return confirm('Apa yakin ingin mengembalikan semua data ini?')">Restore All</a>
        </button>
        <button type="button" class="btn-sm btn-danger btn-icon-text" onclick="">
            <i class="mdi mdi-delete-forever btn-icon-prepend fa fa-trash"></i>
            <a href="/products-delete-all" style="color: white"  onclick="return confirm('Apa yakin ingin menghapus permanen semua data ini?')">Delete All</a>
        </button>
        </span>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>
               Nama Produk
				</th>
				<th>
				Kategori
				</th>
                <th>
                  Rating
                </th>
                <th>
                  Stock
                </th>
                <th>
                  Berat
                </th>
                <th>
                  Harga
                </th>
                <th>
                  Deskripsi Produk
                </th>
                <th colspan="2" style="text-align:center;">
                  Action
                </th>
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
                    <a class="btn-sm btn-info fa fa-undo" href="/products/restore/{{ $product->id }}"  onclick="return confirm('Apa yakin ingin mengembalikan data ini?')"></a>
				</td>
				<td>
					<a class="btn-sm btn-danger fa fa-trash" href="/products/destroy/{{ $product->id }}"  onclick="return confirm('Apa yakin ingin menghapus permanen data ini?')"></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {!! $products->links() !!}
		</div>
</div>
@endsection