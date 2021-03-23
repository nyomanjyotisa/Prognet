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
          <h2>Transaction Detail</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="checkout.html">Transaction</a>
          <a href="checkout.html">Transaction Detail</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
  <div class="container">
    <div class="billing_details">
      <h3>Billing Details</h3>
      <div class="row">
        <div class="col-lg-6 row contact_form">
          <div class="col-md-12 form-group p_star">
            <label>Nama</label>
            <input
              type="text"
              class="form-control text-dark"
              id="name"
              name="name"
              placeholder="Name"
              value="{{Auth::user()->name}}"disabled
            />
          </div>
          <div class="col-md-6 form-group p_star">
            <label>No Telp</label>
            <input
              type="text"
              class="form-control text-dark"
              value="{{$transaksi->telp}}"disabled
            />
          </div>
          <div class="col-md-6 form-group p_star">
            <label>Email</label>
            <input
              type="text"
              class="form-control text-dark"
              id="email"
              name="compemailany"
              placeholder="Email Address"
              value="{{Auth::user()->email}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Provinsi</label>
            <input
              type="text"
              class="form-control text-dark"
              name="compemailany"
              value="{{$transaksi->province}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Kota</label>
            <input
              type="text"
              class="form-control text-dark"
              name="compemailany"
              value="{{$transaksi->regency}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Alamat</label>
            <input
              type="text"
              class="form-control text-dark"
              id="address"
              name="address"
              value="{{$transaksi->address}}"disabled
            />
          </div>
          <div class="col-md-12 form-group p_star">
            <label>Kurir</label>
            <input
              type="text"
              class="form-control text-dark"
              value="{{$transaksi->courier->courier}}"disabled
            />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="order_box">
            <h2>Your Order</h2>
            <ul class="list">
              @php
                if($transaksi->status == 'unverified' && !is_null($transaksi->proof_of_payment))
                {$transaksi->status = 'Menunggu Verifikasi';}
              @endphp
              <li>
                <a href="#">
                  Status
                  @if ($transaksi->status == 'success')
                    <span style="color: white;" class="btn-sm btn-success font-weight-bold  mt-1">{{$transaksi->status}}</span>
                  @elseif ($transaksi->status == 'Menunggu Verifikasi' || $transaksi->status == 'delivered' || $transaksi->status == 'verified')
                    <span style="color: white;" class="btn-sm btn-warning font-weight-bold  mt-1">{{$transaksi->status}}</span>
                  @else
                    <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1">{{$transaksi->status}}</span>
                  @endif
                </a>
              </li>
              @foreach ($transaksi->transaction_detail as $item)
              <li>
                <a href="#">
                {{$item->product->product_name}}<span class="middle">x {{$item->qty}}</span>
                <span>Rp{{number_format($item->selling_price)}}</span>
                </a>
              </li>
              @endforeach
              <li>
                <a href="#"
                  >Sub Total
                  <span>Rp{{number_format($transaksi->sub_total)}}</span>
                </a>
              </li>
              <li>
                <a href="#"
                  >Shipping
                  <span>Rp{{$transaksi->shipping_cost}}</span>
                </a>
              </li>
            </ul>
            <ul class="list list_2">
              <li>
                <a href="#"
                  >Total
                  <span class = "font-weight-bold">Rp{{number_format($transaksi->total)}}</span>
                </a>
              </li>
              <li>
                <a href="">
                  Proof Of Payment
                  @if (is_null($transaksi->proof_of_payment) && $transaksi->status == 'unverified')
                    <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="file" name="file" id="form19" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required>
                      <span> 
                        <button type="submit" class="text-white btn btn-info font-weight-bold  mt-2">Send</button>
                      </span>
                    </form>
                  @elseif ($transaksi->proof_of_payment)
                    <span class = "text-white btn-sm btn-success font-weight-bold  mt-2">Sudah diupload</span>
                  @endif
                </a>
              </li>
              <li>
                @if ($transaksi->status == 'unverified' && is_null($transaksi->proof_of_payment))
                  <div class="d-flex justify-content-center mt-5">
                    <form action="/transaksi/detail/status" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="hidden" name="status" value="1">
                      <button style="color:white;margin-left:10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa yakin ingin membatalkan pesanan ini?')">Batalkan Pesanan</button>
                    </form>
                  </div>  
                @else
                  @if ($transaksi->status == 'delivered')
                  <a href="">
                    <form action="/transaksi/detail/status" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="hidden" name="status" value="2">
                      <span><button type="submit" class="text-white btn-sm btn-primary font-weight-bold  mt-2">Pesanan Sudah Sampai</button></span>
                    </form>
                  </a>
                  @endif
                @endif
                <div class="d-flex justify-content-center mt-5">
                  <a href="/home"><button style="color:white;" class="btn btn-primary btn-rounded fa fa-home fa-2x"> Belanja Lagi</button></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection