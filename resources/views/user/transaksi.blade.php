@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div
        class="banner_content d-md-flex justify-content-between align-items-center"
      >
        <div class="mb-3 mb-md-0">
          <h2>Transaction</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="#">Transaction</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="cart_area">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>
                <strong>Sisa Waktu Bayar</strong>
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
                <strong>Aksi</strong>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transaksi as $item)
              <tr> 
                <td>
                  @if ($item->status == 'unverified' & $item->timeout > date('Y-m-d H:i:s') & is_null($item->proof_of_payment))
                    @php
                      date_default_timezone_set("Asia/Makassar");
                      $date1 = new DateTime($item->timeout);
                      $date2 = new DateTime(date('Y-m-d H:i:s'));
                      $tenggat = $date1->diff($date2);
                    @endphp
                      <span class="btn-sm btn-warning font-weight-bold">{{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
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
                    <strong>Rp{{number_format($item->total)}}</strong>
                </td>
                <td>
                  @if ($item->status == 'success')
                    <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1">{{$item->status}}</span>
                  @elseif ($item->status == 'delivered' || $item->status == 'verified' || $item->status == 'in delivery')
                    <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1">{{$item->status}}</span>
                  @else
                    <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1">{{$item->status}}</span>
                  @endif
                </td>
                <td>
                  <a href="/transaksi/detail/{{$item->id}}"><strong>Lihat Detail</strong></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection