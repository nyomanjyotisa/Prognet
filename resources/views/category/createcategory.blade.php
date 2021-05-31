@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row align-items-centre">
		<div class="col-lg-2">
		</div>
		<div class="col-md-8">
			<div class="component">
				<div class="card">
					<form class="form-signin" action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="card-header">
							<center>
								<h2>Tambah Kategori</h2>
								<br>
							</center>
						</div>
				<div class="card-body">
					<div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" class="form-control" placeholder="Nama Kategori" aria-label="Nama Kategori" aria-describedby="basic-addon1" name="category_name">
				</div>
				<div class="card-footer" align="center">
					<button class="btn btn-md btn-primary btn-icon-text" type="submit">
						<i class="mdi mdi-arrow-right btn-icon-prepend fa fa-plus"></i> Add Category
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
<br><br><br><br><br><br><br><br><br><br><br>
@endsection