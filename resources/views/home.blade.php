@extends('layouts.app')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
  <video autoplay muted loop id="myVideo" style="width:100%;   position: absolute;
  object-fit: cover; 
    z-index: 0;">
    <source src="{{ asset('user/home.webm') }}" type="video/webm">
  </video>
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content row">
        <div class="col-lg-12">
          <p class="sub text-uppercase" style="color:black;">men Collection</p>
          <h3 style="color:#222;"><span>Show</span> Your <br />Personal <span>Style</span></h3>
          <h4 style="color:black;">Fowl saw dry which a above together place.</h4>
          <a class="main_btn mt-40" href="#">View Collection</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!-- Start feature Area -->
<section class="feature-area section_gap_bottom_custom">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <a href="#" class="title">
            <i class="flaticon-money"></i>
            <h3>Money back gurantee</h3>
          </a>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <a href="#" class="title">
            <i class="flaticon-truck"></i>
            <h3>Free Delivery</h3>
          </a>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <a href="#" class="title">
            <i class="flaticon-support"></i>
            <h3>Alway support</h3>
          </a>
          <p>Shall open divide a one</p>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="single-feature">
          <a href="#" class="title">
            <i class="flaticon-blockchain"></i>
            <h3>Secure payment</h3>
          </a>
          <p>Shall open divide a one</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End feature Area -->

<!--================ Inspired Product Area =================-->
<section class="inspired_product_area section_gap_bottom_custom">
  
  <div class="container">
  
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>Inspired products</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
        <ul class="nav nav-tabs" >
        <div class="container">
          <div class="row">
            <div class="col-sm d-flex justify-content-center">
              <div class="form-group">
                <input class="form-check-input radiobtn" name="group100" type="radio" id="radio100" selected checked value="0">
                <label for="radio100" class="form-check-label dark-grey-text">All</label>
              </div>
            </div>
            <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
            @foreach ($category as $item)
              @if ($item->product->count())
                <div class="col-sm d-flex justify-content-center">
                  <div class="form-group">
                      <input class="form-check-input radiobtn" name="group100" type="radio" id="radio10{{$loop->iteration}}" value="{{$item->id}}">
                      <label for="radio10{{$loop->iteration}}" class="form-check-label dark-grey-text">{{$item->category_name}}</label>
                  </div>
                </div>
              @else
                <input type="hidden" id="radio10{{$loop->iteration}}" class="radiobtn">
              @endif
            @endforeach
          </div>
        </div>
        </ul>
      </div>
    </div>


    <div class="ganti">
      <div class="products">
        <div class="container">
          <div class="row">
            @foreach ($product as $products)
              <div class="col-lg-3 col-md-6">
                <div class="single-product">
                  <div class="product-img">
                    @foreach ($products->product_image as $image)
                      <img class="img-fluid w-100" src="/uploads/product_images/{{$image->image_name}}" alt="" />
                      @break
                    @endforeach
                    @php
                        $home = new Home;
                        $disc = $home->tampildiskon($products->discount);
                    @endphp
                    @if($disc!=0)
                      <div style="background-color:red;"class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
                    @endif
                    <div class="p_icon">
                      <a href="/product/{{$products->id}}">
                        <i class="ti-eye"></i>
                      </a>
                      <a href="#">
                        <i class="ti-shopping-cart"></i>
                      </a>
                    </div>
                  </div>
                  <div class="product-btm">
                    <a href="/product/{{$products->id}}" class="d-block">
                      <h4>{{$products->product_name}}</h4>
                    </a>
                    <div class="mt-3">
                      <div class="row m-auto">
                        @if ($products->stock == 0)
                          <div class="col badge badge-danger mb-2 mr-4">Out Of Stock!</div>
                        @else
                          <div class="col"></div>
                        @endif
                        <div class="col"></div>
                      </div>	
                      @php
                        $home = new Home;
                        $harga = $home->diskon($products->discount,$products->price);
                      @endphp
                      @if ($harga != 0)	 
                        <del>Rp{{number_format($products->price)}}</del>  <br>
                        <span class="mr-4">Rp{{number_format($harga)}}</span>
                      @else
                        <span class="mr-4">Rp{{number_format($products->price)}}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Inspired Product Area =================-->

<!--================ Offer Area =================-->
<section class="offer_area">
  <div class="container">
    <div class="row justify-content-center">
      <div class="offset-lg-4 col-lg-6 text-center">
        <div class="offer_content">
          <h3 class="text-uppercase mb-40"></h3>
          <h2 class="text-uppercase"></h2>
          <p></p><br><br><br><br><br><br><br><br><br>
          <br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Offer Area =================-->

<!--================ Start Blog Area =================-->
<section class="blog-area section-gap mt-5 pt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="main_title">
          <h2><span>latest blog</span></h2>
          <p>Bring called seed first of third give itself now ment</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="single-blog">
          <div class="thumb">
            <img class="img-fluid" src="img/b1.jpg" alt="">
          </div>
          <div class="short_details">
            <div class="meta-top d-flex">
              <a href="#">By Admin</a>
              <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
            </div>
            <a class="d-block" href="single-blog.html">
              <h4>Ford clever bed stops your sleeping
                partner hogging the whole</h4>
            </a>
            <div class="text-wrap">
              <p>
                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                Forth.
              </p>
            </div>
            <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <div class="single-blog">
          <div class="thumb">
            <img class="img-fluid" src="img/b2.jpg" alt="">
          </div>
          <div class="short_details">
            <div class="meta-top d-flex">
              <a href="#">By Admin</a>
              <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
            </div>
            <a class="d-block" href="single-blog.html">
              <h4>Ford clever bed stops your sleeping
                partner hogging the whole</h4>
            </a>
            <div class="text-wrap">
              <p>
                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                Forth.
              </p>
            </div>
            <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="single-blog">
          <div class="thumb">
            <img class="img-fluid" src="img/b3.jpg" alt="">
          </div>
          <div class="short_details">
            <div class="meta-top d-flex">
              <a href="#">By Admin</a>
              <a href="#"><i class="ti-comments-smiley"></i>2 Comments</a>
            </div>
            <a class="d-block" href="single-blog.html">
              <h4>Ford clever bed stops your sleeping
                partner hogging the whole</h4>
            </a>
            <div class="text-wrap">
              <p>
                Let one fifth i bring fly to divided face for bearing the divide unto seed winged divided light
                Forth.
              </p>
            </div>
            <a href="#" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ End Blog Area =================-->

@endsection

@section('script')
<script>
    jQuery(document).ready(function(e){
        jQuery('.radiobtn').click(function(e){
            var index = $('.radiobtn').index(this);
            console.log(jQuery('#radio10'+index).val());
            jQuery.ajax({
                url: "{{url('/show_categori')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    id: jQuery('#radio10'+index).val(),
                },
                success: function(result){
                    $('.ganti').html(result.hasil);
                }
            });
        });
    });
  </script>
@endsection