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
        <h2 class="card-title" align="center">List Kurir</h2>
        <br>
            <button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
                    <i class="mdi mdi-upload btn-icon-prepend fa fa-plus"></i>     
                    <a href="{{ route('couriers.create') }}" style="color: white;">Tambah Kurir</a>
            </button>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
					        <th>
						          No.
					        </th>
                    <th>
                      Nama Kurir
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($couriers as $courier)
                  <tr>
					<td>{{ $loop->iteration }}</td>
                    <td>{{ $courier->courier }}</td>
                    <td>
                        <a class="btn-sm btn-warning fa fa-pencil" href="{{ route('couriers.edit',$courier->id)}}"></a>

              <form action="{{ route('couriers.destroy', $courier->id)}}" method="post">
							{{ csrf_field() }}
							@method('DELETE')
							<button class="btn btn-danger fa fa-trash" type="submit" onclick="return confirm('Apa yakin ingin menghapus data ini?')"></button>
						  </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $couriers->links() !!}
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
<br><br><br><br><br><br><br><br><br><br><br><br>
@endsection