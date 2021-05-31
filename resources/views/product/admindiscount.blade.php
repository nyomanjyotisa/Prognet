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
		<h2 class="card-title" align="center">List Diskon</h2 >
		<br>
		<span>
		<button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
			<i class="mdi mdi-upload btn-icon-prepend fa fa-plus"></i>     
			<a href="/addDiscount/{{ $prd }}" style="color: white;">Tambah Diskon</a>
		</button>
		</span>
		  <table class="table table-striped table-hover" style="width:1100px;">
			<thead>
			  <tr>
				<th >
					No.
			 	</th>
				<th >
			   		Persentase Diskon
				</th>
				<th >
					Start
				</th>
				<th>
					End
				</th>
				<th colspan="2" style="text-align: center;">
				  Action
				</th>
			  </tr>
			</thead>
			<tbody>
			  @foreach($discounts as $discount)
			  @forelse($valid as $val)
			  <tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $val->percentage }}%</td>
				<td>{{ date('Y-m-d', strtotime($val->start)) }}</td>
                <td>{{ date('Y-m-d', strtotime($val->end)) }}</td>
				<td align="center">
					<a class="btn-sm btn-warning fa fa-pencil" href="{{ route('discounts.edit',$val->id)}}"></a>
				
					<form action="{{ route('discounts.destroy', $val->id)}}" method="post">
						{{ csrf_field() }}
						@method('DELETE')
						<button class="btn btn-danger fa fa-trash" type="submit" onclick="return confirm('Apa yakin ingin menghapus data ini?')"></button>
					</form>
				</td>
			  </tr>
			  @empty
			  <td colspan="5" align="center">Tidak ada Diskon!</td>
			  @endforelse
			  @endforeach
			</tbody>
		  </table>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection