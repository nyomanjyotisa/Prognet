@extends('layouts.main')
@section('content')
<div class="container">
	<div class="row align-items-centre">
		<div class="col-lg-2">
		</div>
		<div class="col-md-8">
			<div class="component">
				<div class="card">
					<form class="form-signin" action="/addDiscount/{{ $products->id }}" method="post" enctype="multipart/form-data">
						@csrf
					<div class="card-header">
						<center>
							<h2>Tambah Diskon</h2>
							<br>
						</center>
					</div>
				<div class="card-body">
					<div class="form-group">
						<label>Percentage</label>
						<input type="text" class="form-control" placeholder="Persentase Diskon %" name="percentage">
						<span class="text-danger">{{ $errors->first('percentage') }}</span>
					</div>
					<div class="form-group">
						<label>Start Discount</label>
						<input type="date" class="form-control" col="12" name="start">
						<span class="text-danger">{{ $errors->first('start') }}</span>
					</div>
					<div class="form-group">
						<label>End Discount</label>
						<input type="date" class="form-control" col="12" name="end">
						<span class="text-danger">{{ $errors->first('end') }}</span>
					</div>
						<div class="card-footer" align="center">
							<button class="btn btn-md btn-primary btn-icon-text" type="submit">
								<i class="mdi mdi-arrow-right btn-icon-prepend fa fa-plus"></i> Add Discount
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br><br><br>
@endsection