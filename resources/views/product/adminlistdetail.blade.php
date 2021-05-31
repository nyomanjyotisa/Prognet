@extends('layouts.main')
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          	<strong>{{ $message }}</strong>
    </div>
@endif
        <h2 class="card-title" style="text-align: center;">Detail Produk</h2>
        <br>
		<div class="table">
		  <table class="table table-striped table-bordered " align='center' >
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
            
		<button type="button" class="btn btn-success btn-icon-text" onclick="/addImage/{{ $product->id }}">
				<i class="mdi mdi-file-restore btn-icon-prepend fa fa-picture-o"></i>     
				<a href="/addImage/{{ $product->id }}" style="color: white;">Tambah Foto Produk</a>
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
				  <button type="submit" class="btn btn-danger btn-icon-text fa fa-trash" onclick="return confirm('Apa yakin ingin menghapus gambar ini?')">
                 </button>
                </div>
				 </form>
				</div>
			  </div>
			  @empty
			  <h1 align="center"> Tidak ada foto!</h1>
			  @endforelse
			</div>
		  </div>
		  
			<h2 align="center" class="card-title">Review Produk</h4>
				<br>
				<div class="table">
				  <table class="table table-striped table-bordered " align='center'>
					<thead>
					  <tr>
						<th>No</th>
						<th>Nama User</th>
						<th>Rate</th>
						<th>Review</th>
						<th>Response</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					  @foreach($reviews as $review)
						<tr>
						  <td>{{ $loop->iteration }}</td>
						  <td>{{ $review->name }}</td>
						  <td>{{ $review->rate }}</td>
						  <td>{{ $review->content }}</td>
						  <td>@foreach($responses as $response)
								@if($review->id == $response->review_id)
								  {{ $response->content }}
								@endif
							  @endforeach
						  </td>
						  <td>
							  <button type="button" id="balas" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#response-{{$review->id}}">Balas</button></td>
						</tr>
						<script>
							$('#balas').click(function(e){
								e.preventDefault();
								$('#response-{{$review->id}}').modal();
							});
						</script>
						<!-- Modal -->
							<div class="modal" id="response-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Response Review</h5>
								  </div>
								  <div class="modal-body">
									<form action="{{route('response.store')}}" method="POST">
									  @csrf
									  <div class="form-group">
										<input type="text" name="" readonly="" value="{{$review->content}}" class="form-control">
									  </div>
									  <div class="form-group">
										<label>Respon</label>
										<input type="text" name="content" class="form-control" style="width: 80%; margin-right: 20px;" placeholder="Respon review">
										<input type="hidden" name="review_id" value="{{$review->id}}">
										<input type="hidden" name="admin_id" value="{{Auth::user()->id}}">
									  </div>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
									<button type="submit" class="btn btn-primary">Kirim</button>
									</form>
								  </div>
								</div>
							  </div>
							</div>
					  @endforeach
					</tbody>
				  </table>
				</div>
@endsection