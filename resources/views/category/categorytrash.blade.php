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
		<h2 class="card-title" align="center">List Trash Produk</h2>
		<br>
        <span>
        <button type="button" class="btn-sm btn-warning btn-icon-text" onclick="">
            <i class="mdi mdi-keyboard-backspace btn-icon-prepend fa fa-arrow-left"></i>     
            <a href="/categories" style="color: white;">Back</a>
        </button>
        <button type="button" class="btn-sm btn-success btn-icon-text" onclick="">
            <i class="mdi mdi-file-restore btn-icon-prepend fa fa-undo"></i>     
            <a href="/categories-restore-all" style="color: white;"  onclick="return confirm('Apa yakin ingin mengembalikan semua data ini?')">Restore All</a>
        </button>
        <button type="button" class="btn-sm btn-danger btn-icon-text" onclick="">
            <i class="mdi mdi-delete-forever btn-icon-prepend fa fa-trash"></i>
            <a href="/categories-delete-all" style="color: white"  onclick="return confirm('Apa yakin ingin menghapus permanen semua data ini?')">Delete All</a>
        </button>
        </span>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>
             Nama Kategori
              </th>
              <th>
                Action
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
            <tr>
              <td>{{ $category->category_name }}</td>
              <td>
                  <a class="btn-sm btn-info fa fa-undo" href="/categories/restore/{{ $category->id }}"  onclick="return confirm('Apa yakin ingin mengembalikan data ini?')"></a>
                  <a class="btn-sm btn-danger fa fa-trash" href="/categories/destroy/{{ $category->id }}"  onclick="return confirm('Apa yakin ingin menghapus permanen data ini?')"></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $categories->links() !!}
      </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
@endsection