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
          <h2>Product Checkout</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="checkout.html">Product Checkout</a>
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
                    @else
                      <span style="color: white;" class="btn-sm btn-danger font-weight-bold mt-1">{{$transaksi->status}}</span>
                    @endif
                  </a>
                </li>
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
                    <span class = "text-white btn-sm btn-danger font-weight-bold mt-2">Belum diupload</span>
                    @else
                    <span class = "text-white btn-sm btn-success font-weight-bold  mt-2">Sudah diupload</span>
                    @endif</a>
                </li>
                <li>
                  @if ($transaksi->status == 'unverified' && is_null($transaksi->proof_of_payment))
                      <br>
                      <div class="d-flex flex-row bd-highlight mt-3">
                          <button style="margin-left:35px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalContactForm">Upload Bukti Pembayaran</button>
                          <form action="/transaksi/detail/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$transaksi->id}}">
                            <input type="hidden" name="status" value="1">
                            <button style="color:white;margin-left:10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apa yakin ingin membatalkan pesanan ini?')">Batalkan Pesanan</button>
                          </form>
                      </div>  
                  @else
                      @if ($transaksi->status == 'delivered')
                      <div class="d-flex flex-row bd-highlight mb-3">
                        <form action="/transaksi/detail/status" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{$transaksi->id}}">
                          <input type="hidden" name="status" value="2">
                          <button style="margin-left:126px;" type="submit" class="btn btn-primary btn-sm">Pesanan Sudah Sampai</button>
                        </form>
                    </div> 
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
    <div class="container ganti">
    <section class="section my-5 pb-5">
      <!-- Shopping Cart table -->
      <div style="color:#333333;" class="table-responsive">
        <h1 align="center">Rincian Produk</h1>
        <table class="table product-table table-cart-v-1">
          <!-- Table head -->
          <thead>
            <tr>
              <th></th>
              <th class="font-weight-bold">
                <strong>Product</strong>
              </th>
              <th></th>
              <th class="font-weight-bold">
                <strong>Diskon</strong>
              </th>
              <th class="font-weight-bold">
                <strong>Price</strong>
              </th>
              <th class="font-weight-bold">

                <strong>QTY</strong>

              </th>  
              <th></th>
              <!-- @if ($transaksi->status == 'success')
              <th class="font-weight-bold">
                <strong>Berikan Review</strong>
              </th> 
              @endif -->
            </tr>

          </thead>
          <!-- Table head -->

          <!-- Table body -->
          <tbody>

            <!-- First row -->
            @foreach ($transaksi->transaction_detail as $item)
            <tr>
              <th scope="row">
                  @foreach ($item->product->product_image as $image)
                  
                      <img style="width:50px; height:50px;" src="{{asset('/uploads/product_images/'.$image->image_name)}}" alt="" class="img-fluid z-depth-0">
                      @break
                  @endforeach
              </th>
              <td>
                <h5 class="mt-3">
                  <input type="hidden" name="id" id="product_id{{$loop->iteration-1}}" value="{{$item->product->id}}">
                  <strong>{{$item->product->product_name}}</strong>
                </h5>
              </td>
              <td></td>
              <td>{{$item->discount}}%</td>
              <td>Rp.{{$item->selling_price}}</td>
              <td class="text-center text-md-left">

                <span>{{$item->qty}} </span>

              </td>
              <td></td>
              <!-- @if ($transaksi->status == 'success')
              <td>
                  @php
                      $status = 0;
                  @endphp
                  @foreach ($review as $pr)
                       @php
                           if($item->product->id == $pr->product_id){
                              $status = $status + 1;
                           }else{
                              $status = $status;
                           }
                       @endphp
                  @endforeach
                  @if ($status != 0)
                      
                      <button class="btn btn-sm btn-success tambah-review" data-toggle="modal" data-target="#modalTambahReview" disabled>Review telah diberikan</button>
                      
                  @else
                      <button class="btn btn-sm btn-success tambah-review" data-toggle="modal" data-target="#modalTambahReview">+Tambah Review</button>
                      
                  @endif
              </td>    
              @endif -->
            </tr>
            @endforeach

          </tbody>
          <!-- Table body -->

        </table>

      </div>
      <!-- Shopping Cart table -->

    </section>
  </div>
  <!-- Main Container -->

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