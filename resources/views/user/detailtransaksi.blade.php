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
                  <a href="#"
                    >Status
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
              <span>Rp.{{$item->selling_price}}</span>
              </a>
            </li>
            @endforeach
              <li>
                <a href="#"
                  >Sub Total
                  <span>Rp.{{$transaksi->sub_total}}</span>
                </a>
              </li>
              <li>
                <a href="#"
                  >Shipping
                  <span>Rp.{{$transaksi->shipping_cost}}</span>
                </a>
              </li>
              
            </ul>
            <ul class="list list_2">
              <li>
                <a href="#"
                  >Total
                  <span class = "font-weight-bold">Rp.{{$transaksi->total}}</span>
                </a>
              </li>
              <li><a href="">
                Proof Of Payment
                    @if (is_null($transaksi->proof_of_payment))
                    <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" value="{{$transaksi->id}}">
                      <input type="file" name="file" id="form19" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required>
                      <span><button type="submit" class="text-white btn btn-info font-weight-bold  mt-2">Send</button></span>
                    </form>
                    @else
                    <span class = "text-white btn-sm btn-success font-weight-bold  mt-2">Sudah diupload</span>
                    @endif</a>
                </li>
                <li>
                  @if ($transaksi->status == 'unverified' && is_null($transaksi->proof_of_payment))
                      <div class="d-flex justify-content-center mt-5">
                          <!-- <button style="margin-left:35px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalContactForm">Upload Bukti Pembayaran</button> -->
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

    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog cascading-modal" role="document">
        <!-- Content -->
        <div class="modal-content">

          <!-- Header -->
          <div class="modal-header light-blue darken-3 white-text">
            <h4 class="">Bukti Pembayaran</h4>
            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- Body -->
          <div class="modal-body mb-0">
            <form action="/transaksi/detail/proof" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="md-form form-sm">
              Masukkan Bukti Pembayaran
              <input type="hidden" name="id" value="{{$transaksi->id}}">
              <input type="file" name="file" id="form19" class="form-control form-control-sm" accept=".jpeg,.jpg,.png,.gif" onchange="preview_image(event)" required>
            </div>
            <br><br>
            <div class="text-center mt-1-half">
              <button type="submit" class="btn btn-info mb-2">Send</button>
            </div>
            </form>
          </div>
          <div class="d-flex justify-content-center">
            <img src=""  id="output_image" class="mb-2 mw-50 w-50 h-50 rounded">
          </div>
        </div>
        <!-- Content -->
      </div>
    </div>

    <!-- Modal: Tambah Review -->
    <div class="modal fade" id="modalTambahReview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
      <!-- Content -->
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header light-blue darken-3 white-text">
          <h4 class="">Tambah Rating dan Review Produk</h4>
          <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- Body -->
        <div class="modal-body mb-0">
            <input type="hidden" name="product_id" id="product_id" value="">
            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
          <div class="md-form form-sm">
            Masukkan Rate untuk Produk
            <select name="rate" id="rate" class="form-control form-control-sm">
              @for ($i = 0; $i < 6; $i++)
              <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
          <br><br>
          <div class="md-form form-sm">
            <textarea type="text" id="content" class="md-textarea form-control form-control-sm" rows="3" required></textarea>
          </div>
          <br><br>
          <div class="text-center mt-1-half">
            <button type="submit" class="btn btn-info mb-2" id="kirim-review">Send</button>
          </div>
        </div>
      </div>
      <!-- Content -->
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('script')
<script src="{{ asset ('assets/User/styles/bootstrap4/popper.js')}}"></script>
<script>
  $(document).ready(function(e){
       $(".tambah-review").click(function(e){
        var index = $(".tambah-review").index(this);
        var product_id = $("#product_id"+index).val();
        $("#product_id").val(product_id);
      });

      $("#kirim-review").click(function(e){
        jQuery.ajax({
              url: "{{url('/transaksi/detail/review')}}",
              method: 'post',
              data: {
                  _token: $('#signup-token').val(),
                  product_id: $("#product_id").val(),
                  user_id: $("#user_id").val(),
                  rate: $("#rate").val(),
                  content: $("#content").val(),
              },
              success: function(result){
                $('#modalTambahReview').modal('hide');
                alert('Berhasil Menambah Review');
                location.reload();
              }
          });
      });
  
        
  });
</script>
<script type="text/javascript">
  function preview_image(event){
    let reader = new FileReader();
    var fileExtention = '';
    reader.onload = function(){
      let output = document.getElementById('output_image');
      output.src = reader.result;
      fileExtention = output.src.split('/');
      fileExtention = fileExtention[1];
      fileExtention = fileExtention.split(';');
      console.log(fileExtention[0]);
    }
    if(event.target.files[0]){
      reader.readAsDataURL(event.target.files[0]);
    }
  }
</script>
@endsection