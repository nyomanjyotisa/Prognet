@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row align-items-centre">
		<div class="col-lg-2">
		</div>
		<div class="col-md-8">
			<div class="component">
				<div class="card">
					<form class="form-signin" action="/addImage/{{ $products->id }}" method="post" enctype="multipart/form-data">
						@csrf
					<div class="card-header">
						<center>
							<h2>Tambah Foto Produk</h2>
							<br>
						</center>
					</div>
				<div class="card-body">
					<div class="form-group">
						<label>Pilih Foto</label>
						<input type="file" class="form-control" placeholder="Nama Produk" aria-label="Nama Produk" aria-describedby="basic-addon1" name="files[]" multiple>
					</div>
					
					</div>
						<div class="card-footer" align="center">
							<button class="btn btn-success fa fa-plus" type="submit"> Add</button>
						</div>
						<br><br><br><br><br><br>
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
<br><br><br><br><br>
@endsection