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
            <h2 class="card-title" align="center">List Kategori</h2>
            <br>
            <button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
                    <i class="mdi mdi-upload btn-icon-prepend fa fa-plus"></i>     
                    <a href="{{ route('categories.create') }}" style="color: white;">Tambah Kategori</a>
            </button>
            <button type="button" class="btn-sm btn-danger btn-icon-text" onclick="">
                <i class="mdi  mdi-delete btn-icon-prepend fa fa-trash"></i>
                <a href="/categories-trash" style="color: white">Trash</a>
            </button>
              <table class="table table-striped table-hover"style="width:1100px;">
                <thead>
                  <tr>
                    <th>
                      No.
                    </th>
                    <th>
                      Nama Kategori
                    </th>
                    <th colspan="2" >
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td style="align: center;">
                        <a class="btn-sm btn-warning fa fa-pencil" href="{{ route('categories.edit',$category->id)}}"></a>        
                        <a class="btn-sm btn-danger fa fa-trash" href="/categories/delete/{{ $category->id }}" onclick="return confirm('Apa yakin ingin menghapus data ini?')"></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $categories->links() !!}
          </div>
          </div>
  </div>
  </div>
  </div>
  </div>
<br><br><br><br><br><br>
@endsection