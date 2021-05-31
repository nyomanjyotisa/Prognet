@extends('layouts.table')
@section('judul','Admin | Kategori Page')
@section('content')
    <div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Kategori</h4>
                  <button type="button" class="btn-sm btn-success btn-icon-text" onclick="/createProduct">
                          <i class="mdi mdi-upload btn-icon-prepend"></i>     
                          <a href="{{ route('categories.create') }}" style="color: white;">Tambah Kurir</a>
                  </button>
                  <button type="button" class="btn-sm btn-danger btn-icon-text" onclick="">
                      <i class="mdi  mdi-delete btn-icon-prepend"></i>
                      <a href="/categories-trash" style="color: white">Trash</a>
                  </button>
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
                              <a class="btn-sm btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
    
                              <a class="btn-sm btn-warning" href="{{ route('categories.edit',$category->id)}}">Edit</a>
                              
                              <a class="btn-sm btn-danger" href="/categories/delete/{{ $category->id }}" onclick="return confirm('Apa yakin ingin menghapus data ini?')">Delete</a>
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
@endsection