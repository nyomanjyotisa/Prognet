@extends('layouts.adminApp')
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          	<strong>{{ $message }}</strong>
    </div>
@endif
<div class="main-panel">
  <div class="content-wrapper">
    <div class="grid-margin stretch-card">
      <div class="card">
        <h2 class="card-title" style="text-align: center;">Detail Produk</h2>
        <br>
		<div class="table-responsive">
            <table class="table table-hover">
			@foreach($products as $product)
			<tbody>
			  <tr>
				<th>Nama Produk</th>
				<td>{{ $product->product_name }}</td>
			  </tr>
			  <tr>
				<th>Rating Produk</th>
				<td>{{ $product->product_rate }}</td>
			  </tr>
			  <tr>
				<th>Stock</th>
				<td>{{ $product->stock }}</td>
			  </tr>
			  <tr>
				<th>Berat</th>
				<td>{{ $product->weight }}</td>
			  </tr>
			  <tr>
				<th>Harga</th>
				<td>Rp. {{number_format($product->price)}}</td>
			  </tr>
			  <tr>
				<th>Deskripsi</th>
				<td>{{ $product->description }}</td>
			  </tr>
			  <tr>
				<th>Kategori</th>
				<td>
					@foreach($categories as $category)
					  <button class="btn btn-light">{{ $category->category_name }}</button>
					@endforeach
				</td>
			  </tr>
			</tbody>
		  </table>
		  <span>
            <div class="wrapper" align="center">
		  <button type="button" class="btn btn-warning btn-icon-text" onclick="/createProduct">
				<i class="mdi mdi-file-restore btn-icon-prepend fa fa-pencil"></i>     
				<a href="{{ route('products.edit',$product->id)}}" style="color: white;">Edit Produk</a>
        </button>
            
		<button type="button" class="btn btn-success btn-icon-text" onclick="/admin/addImage/{{ $product->id }}">
				<i class="mdi mdi-file-restore btn-icon-prepend fa fa-picture-o"></i>     
				<a href="/admin/addImage/{{ $product->id }}" style="color: white;">Tambah Foto Produk</a>
        </button>
            </div>
		@endforeach
        </span>
        <br>
		</div>
      <br><br>
        <h2 class="card-title" align="center">Foto Produk</h2>
        <br>
		  <div class="table">
			<div class="row">
			 @forelse($image as $images)
			  <div class="col-md-4">
				<div class="thumbnail">
				  <img class="img-fluid-left img-thumbnail" src="/uploads/product_images/{{$images->image_name}}" alt="light" style="width:200px; height:200px;">
				  <form method="post" action="{{ route('product_images.destroy', $images->id) }}">
					@csrf
                    @method('DELETE')
                    <div class="wrapper" align="center">
				  <button type="submit" class="btn-sm btn-danger btn-icon-text fa fa-trash" onclick="return confirm('Apa yakin ingin menghapus gambar ini?')">Hapus</button>
                </div>
				 </form>
				</div>
			  </div>
			  @empty
			  <h1 align="center"> Tidak ada foto!</h1>
			  @endforelse

		</tbody>
	 </table>
	</div>
</div>
</div>
</div>
</div>
@endsection