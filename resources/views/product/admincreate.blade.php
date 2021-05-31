@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row align-items-centre">
		<div class="col-lg-2">
		</div>
		<div class="col-md-8">
			<div class="component">
				<div class="card">
					<form class="form-signin" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
						@csrf
					<div class="card-header">
						<center>
							<h2>Tambah Produk</h2>
							<br>
						</center>
					</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon1" name="product_name">
					</div>
					<div class="form-group">
						<label>Harga Satuan</label>
						<input type="text" class="form-control" placeholder="Harga Satuan" aria-label="Harga Satuan" aria-describedby="basic-addon1" name="price">
					</div>
					<div class="form-group">
						<label>Stock</label>
						<input type="text" class="form-control" placeholder="Stock" aria-label="Stock" aria-describedby="basic-addon1" name="stock">
					</div>
					<div class="form-group">
						<label>Berat Produk</label>
						<input type="text" class="form-control" placeholder="Berat Produk" aria-label="Berat Produk" aria-describedby="basic-addon1" name="weight">
					</div>
					<div class="form-group">
						<label class="control-label">Kategori</label>
						<select name="category_id[]" class="selectpicker form-control" multiple data-live-search="true"  multiple="multiple" required>
							@foreach ($categories as $category)
								<option value="{{ $category->id }}">{{ $category->category_name }}</option>
							@endforeach
						</select>
						<br>
					</div>
					<div class="form-group">
						<strong>Description</strong>
						<textarea class="form-control" col="4" name="description" placeholder="Deskripsi Produk"></textarea>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label>Pilih Foto</label>
							<input type="file" class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon1" name="files[]" multiple required>
						</div>	
					</div>
						<div class="card-footer" align="center">
							<button class="btn btn-md btn-primary btn-icon-text" type="submit">
								<i class="mdi mdi-arrow-right btn-icon-prepend fa fa-plus"></i> Add Product
							</button>
						</div>
					</form>
					
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>
				@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection