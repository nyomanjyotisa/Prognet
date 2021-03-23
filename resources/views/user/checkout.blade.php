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
      <div class="row">
        <div class="col-lg-6">
          <h3>Billing Details</h3>
          <form
            action="/beli" method="post"
            class="row contact_form"
            novalidate="novalidate"
            id="checkout_form" class="checkout_form"
          >
          @csrf
            <div class="col-md-12 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                placeholder="Name"
                value="{{Auth::user()->name}}"
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="number"
                name="number"
                placeholder="Phone Number"
              />
            </div>
            <div class="col-md-6 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="email"
                name="compemailany"
                placeholder="Email Address"
                value="{{Auth::user()->email}}"
              />
            </div>
            <div class="col-md-12 form-group p_star">
                  <select name="province" id="provinsi" class="country_select dropdown_item_select checkout_input cekongkir" require="required">
										<option>Provinsi</option>
                      @foreach ($provinsi as $prov)
                        <option value="{{$prov->id}}">{{$prov->title}}</option>
                      @endforeach
									</select>
            </div>
            <div class="col-md-12 form-group p_star">
                  <select name="regency" id="kota" class="country_select dropdown_item_select checkout_input cekongkir" require="required">
										<option value=""></option>
									</select>
            </div>
            <div class="col-md-12 form-group p_star">
              <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                placeholder="Address"
              />
            </div>
            <div class="col-md-12 form-group p_star">
            <select name="courier" id="kurir" class="country_select dropdown_item_select checkout_input cekongkir">
                                        <option>Kurir*</option>
                                        @foreach ($kurir as $k)
                                            <option value="{{$k->id}}">{{$k->courier}}</option>
                                        @endforeach
                                    </select>

            </div>
          
        </div>
        <div class="col-lg-6">
          <div class="order_box">
            <h2>Your Order</h2>
            <ul class="list">
              <li>
                <a href="#"
                  >Sub Total
                  <span>Rp.{{$subtotal}}</span>
                </a>
              </li>
              <li>
                  <div class="order_list_title">Shipping</div>
                  <div class="order_list_value ml-auto" id="biaya-ongkir"></div>
              </li>
              
            </ul>
            <ul class="list list_2">
              <li>
                <a href="#"
                  >Total
                  <span class="middle">Rp.<span id="total-biaya"></span></span>
                </a>
              </li>
            </ul>
            <input type="hidden" name="sub_total" value="{{$subtotal}}">
                  <input type="hidden" name="total" id="totalbiaya">
                  <input type="hidden" name="shipping_cost" id="ongkir">
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <input type="hidden" name="product_id" value="{{$product_id}}">
									<input type="hidden" name="qty" value="{{$qty}}">
            <button type="submit" class="main_btn" id="beli">Proceed to Payment</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    <div class="container ganti">
        <section class="section my-5 pb-5">
  
          <!-- Shopping Cart table -->
          <div style="color:#333333;" class="table-responsive">
            <h1 align="center">Rincian Produk</h1>

            <table class="table product-table">
  
              <!-- Table head -->
              <thead>
  
                <tr>
  
                  <th></th>
  
                  <th class="font-weight-bold">
  
                    <strong>Product</strong>
  
                  </th>
  
                  <th></th>
  
                  <th class="font-weight-bold">
  
                    <strong>Price</strong>
  
                  </th>
  
                  <th class="font-weight-bold">
  
                    <strong>QTY</strong>
  
                  </th>  
                  <th></th>
  
                </tr>
  
              </thead>
              <!-- Table head -->
  
              <!-- Table body -->
              <tbody>
  
                <!-- First row -->
                @foreach ($cart as $item)
                <tr>
                  @if (is_null($item->product))
                  <th scope="row">
                    <input type="hidden" class="id_cart{{$loop->iteration-1}}" value="{{$item->id}}">
                    <input type="hidden" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" class="stock{{$loop->iteration-1}}" value="{{$item->stock}}">
                      @foreach ($item->product_image as $image)
                          <img style="width:50px; height:50px;" src="{{asset('/uploads/product_images/'.$image->image_name)}}" alt=""
                          class="img-fluid z-depth-0">
                          @break
                      @endforeach
                  </th>
  
                  <td>
                    <h5 class="mt-3">
                      <strong>{{$item->product_name}}</strong>
                    </h5>
                  </td>
                  <td></td>
                  @php
                      $home = new Home;
                      $hasil = $home->diskon($item->discount,$item->price);
                  @endphp
                  @if ($hasil != 0)
                         <td> Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$hasil}}</li>
                          Rp.<span class="float-lef grey-text"><small><s>{{$item->price}}</s></small></span>
                        </td>
                  @else
                          <td>Rp.<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$item->price}}</li></td>
                  @endif
                  <td class="text-center text-md-left">
  
                    <span class="qty{{$loop->iteration-1}}">{{$qty}} </span>
  
                  </td>    

                  @else
                  <th scope="row">
                    <input type="hidden" class="id_cart{{$loop->iteration-1}}" value="{{$item->id}}">
                    <input type="hidden" id="user_id" value="{{$item->user_id}}">
                    <input type="hidden" class="stock{{$loop->iteration-1}}" value="{{$item->product->stock}}">
                      @foreach ($item->product->product_image as $image)
                          <img style="width:50px; height:50px;" src="{{asset('/uploads/product_images/'.$image->image_name)}}" alt="" class="img-fluid z-depth-0">
                          @break
                      @endforeach
                  </th>
  
                  <td>
                    <h5 class="mt-3">
                      <strong>{{$item->product->product_name}}</strong>
                    </h5>
                  </td>
                  <td></td>
                  @php
                      $home = new Home;
                      $hasil = $home->diskon($item->product->discount,$item->product->price);
                  @endphp
                  @if ($hasil != 0)
                         <td> Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$hasil}}</li>
                          Rp<span class="float-lef grey-text"><small><s>{{$item->product->price}}</s></small></span></td>
                  @else
                          <td>Rp<span class="float-lef grey-text price{{$loop->iteration-1}}">{{$item->product->price}}</li></td>
                  @endif
                  <td class="text-center text-md-left">
                    <p class="text-danger" style="display:none" id="notif{{$loop->iteration-1}}"></p>
  
                    <span class="qty{{$loop->iteration-1}}">{{$item->qty}} </span>
  
                  </td>    

                  @endif
  
                </tr>
                @endforeach
  
              </tbody>
              <!-- Table body -->
  
            </table>
  
          </div>
          <!-- Shopping Cart table -->
  
        </section>
        <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
        <input type="hidden" value="{{$weight}}" id="weight">
      </div>
  </div>
</section>
<!--================End Checkout Area =================-->
@endsection

@section('script')
<script>
    $(document).ready(function(e){
        $('#provinsi').change(function(e){
            var id_provinsi = $('#provinsi').val()
            if(id_provinsi){
                jQuery.ajax({
                    url: '/kota/'+id_provinsi,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#kota').empty();
                        $.each(data, function(key,value){
                            $('#kota').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }else{
                $('#kota').empty();
            }
        });

        $('.cekongkir').change(function(e){
            var kurir = $('#kurir').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var berat = parseInt($('#weight').val());
            if(provinsi>0 && kurir>0){
                jQuery.ajax({
                    url: "{{url('/ongkir')}}",
                    method: 'POST',
                    data: {
                        _token: $('#signup-token').val(),
                        destination: kota,
                        weight: berat,
                        courier: kurir,
                        prov: provinsi, 
                    },
                    success: function(result){
                        console.log(result.success);
                        console.log(result.hasil["etd"]);
                        $('#biaya-ongkir').text('Biaya Pengiriman: Rp.'+result.hasil["value"]);
                        $('#ongkir').val(result.hasil["value"]);
                        $('#biaya-ongkir').append('<input type="hidden" id="biaya-ongkir" value="'+result.hasil["value"]+'">');
                        $('#biaya-ongkir').append('<li>Estimasi sampai: '+result.hasil["etd"]+'Hari</li>');
                        $('#total-biaya').text({{$subtotal}}+result.hasil["value"]);
                        $('#totalbiaya').val({{$subtotal}}+result.hasil["value"]);
                    }
                });
                // console.log('wrong');
                // console.log('kota: '+kota+' provinsi: '+provinsi+' Kurir: '+kurir)
            }else{
                console.log('wrong');
                console.log('provinsi: '+provinsi+' Kurir: '+kurir)
            }

        });

        $('#beli').click(function(e){
          var kurir = $('#kurir').val();
          var provinsi = $('#provinsi').val();
          var kota = $('#kota').val();
          var alamat = $('#alamat').val();
          var totals = parseInt($('#total-biaya').text());
          var subtotal = parseInt('{{$subtotal}}');
          var ongkir = $('#biaya-ongkir').val();
          var user = $('#user_id').val();
          console.log(totals)
          if(totals==0){
            alert('Tolong Lengkapi Masukan Data');
            return false;
          }
        });
    });
</script>
@endsection