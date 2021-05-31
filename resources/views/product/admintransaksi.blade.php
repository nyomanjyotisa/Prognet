@extends('layouts.main')
@section('content')
<div class="btn-group-horizontal">
    <button class="btn btn-primary status" id="all">All</button>
    <button class="btn btn-warning status" id="unverified">Unverified</button>
    <button class="btn btn-info status" id="waiting">Waiting for Confirmation</button>
    <button class="btn btn-success status" id="verified">Verified</button>
    <button class="btn btn-success status" id="delivered">Delivered</button>
    <button class="btn btn-success status" id="success">Success</button>
    <button class="btn btn-danger status" id="canceled">Canceled</button>
</div>
<br>
<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<!-- Main Container -->
<div class="col-md-12 grid-margin stretch-card ganti">
    <div class="card">
      <!-- Shopping Cart table -->
      <div class="table-responsive">
        <table class="table">
          <!-- Table head -->
          <thead>
            <tr>
              <th>
                <strong>Jatuh Tempo Pembayaran</strong>
              </th>
              <th>
                <strong>ID Transaksi</strong>
              </th>
              <th>
                <strong>Alamat</strong>
              </th>
              <th>
                <strong>Kota</strong>
              </th>
              <th>
                  <strong>Provinsi</strong>
              </th>
              <th>
                  <strong>Total Pembayaran</strong>
              </th>
              <th>
                  <strong>Status</strong>
              </th>
              <th>
                <strong>Opsi</strong>
              </th>
            </tr>

          </thead>
          <!-- Table head -->

          <!-- Table body -->
          <tbody>

            <!-- First row -->
            @foreach ($transaksi as $item)
            
            <tr> 
              <td>
                @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s'))
                @php
                    date_default_timezone_set("Asia/Makassar");
                    $date1 = new DateTime($item->timeout);
                    $date2 = new DateTime(date('Y-m-d H:i:s'));
                    $tenggat = $date1->diff($date2);
                @endphp
                      <span class="badge danger-color">Sisa Waktu Pembayaran: {{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                 @endif

              </td>               
              <td>

                  <strong>{{$item->id}}</strong>
              </td>
              <td>
                  <strong>{{$item->address}}</strong>
              </td>
              <td>
                  <strong>{{$item->regency}}</strong>
              </td>
              <td>
                  <strong>{{$item->province}}</strong>
              </td>
              <td>
                  <strong>Rp{{$item->total}}</strong>
              </td>
              <td>
                  <strong>@if ($item->status == 'unverified' && !is_null($item->proof_of_payment))
                      Menunggu Konfirmasi
                      @else
                      {{$item->status}}
                  @endif</strong>
              </td>
              <td>
                <a href="/admin/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
              </td>
                
            </tr>
          
            @endforeach
            <!-- First row -->


          </tbody>
          <!-- Table body -->

        </table>

      </div>
      <!-- Shopping Cart table -->

  </div>
  <!-- Main Container -->
</div>
<br><br><br><br><br><br><br><br>
@endsection