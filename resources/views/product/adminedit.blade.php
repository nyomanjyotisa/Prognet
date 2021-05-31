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
                        <form class="form-signin" action="{{ route('products.update', $products->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                        <div class="card-header">
                            <center>
								<h2>Edit Produk</h2>
								<br>
                            </center>
                        </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" placeholder="Nama Produk" value="{{ $products->product_name }}" aria-label="Nama Produk" aria-describedby="basic-addon1" name="product_name">
                        </div>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input type="text" class="form-control" placeholder="Harga Satuan" value="{{ $products->price }}" aria-label="Harga Satuan" aria-describedby="basic-addon1" name="price">
						</div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="text" class="form-control" placeholder="Stock" aria-label="Stock" value="{{ $products->stock }}" aria-describedby="basic-addon1" name="stock">
                        </div>
                        <div class="form-group">
                            <label>Berat Produk</label>
                            <input type="text" class="form-control" placeholder="Berat Produk" aria-label="Berat Produk" value="{{ $products->weight }}"  aria-describedby="basic-addon1" name="weight">
						</div>
						<div class="form-group">
							<label class="control-label">Kategori</label>
							<select name="category_id[]" class="selectpicker form-control" multiple data-live-search="true"  multiple="multiple" required>
								@foreach ($category as $categories)
									<option
									@foreach ($categoryDetail as $dataDetail)
										@if ($dataDetail->category_id == $categories->id)
											selected="selected"
										@endif
									@endforeach
									value="{{ $categories->id }}">{{ $categories->category_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<strong>Description</strong>
							<textarea class="form-control" col="4" name="description" placeholder="Deskripsi Produk" >{{ $products->description }}</textarea>
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
@endsection