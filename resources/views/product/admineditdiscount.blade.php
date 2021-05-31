@extends('layouts.main')
@section('content')
@if ($message = Session::get('success'))
      		<div class="alert alert-success alert-block">
        		<button type="button" class="close" data-dismiss="alert">×</button> 
          		<strong>{{ $message }}</strong>
      		</div>
@endif
    <div class="container">
        <div class="row align-items-centre">
            <div class="col-lg-2">
            </div>
            <div class="col-md-8">
                <div class="component">
                    <div class="card">
                        <form class="form-signin" action="{{ route('discounts.update', $discount_info->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                        <div class="card-header">
                            <center>
								<h2>Edit Discount</h2>
								<br>
                            </center>
                        </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text" class="form-control" placeholder="Discount" value="{{ $discount_info->percentage }}" aria-label="Nama Produk" aria-describedby="basic-addon1" name="percentage">
                        </div>
                        <div class="form-group">
							<label>Start Discount</label>
							<input type="date" class="form-control" col="12" name="start" value="{{ $discount_info->start }}">
							<span class="text-danger">{{ $errors->first('start') }}</span>
						</div>
                        <div class="form-group">
							<label>End Discount</label>
							<input type="date" class="form-control" col="12" name="end" value="{{ $discount_info->end }}">
							<span class="text-danger">{{ $errors->first('end') }}</span>
						</div>
                    </div>
                        <div class="card-footer" align="center">
                            <button class="btn btn-success fa fa-pencil" type="submit" onclick="return confirm('Apa yakin ingin mengubah data ini?')"> Edit</button>
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
	<br><br><br><br><br><br><br><br><br>
@endsection