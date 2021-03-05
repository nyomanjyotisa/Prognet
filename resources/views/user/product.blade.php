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
              <h2>Product Details</h2>
              <p>Very us move be blessed multiply night</p>
            </div>
            <div class="page_link">
              <a href="index.html">Home</a>
              <a href="single-product.html">Product Details</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner">
          <div class="col-lg-6">
            <!-- Product Image -->
            <div class="col-lg-11">
              <div class="details_image w-100">
                @foreach ($products->product_image as $jpg)
                  @if($loop->iteration == 1)
                    <div class="details_image_large"><img src="/uploads/product_images/{{$jpg->image_name}}" alt="">
                    </div>
                    <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                  @else
                    <div class="details_image_thumbnail active" data-image="/uploads/product_images/{{$jpg->image_name}}"><img src="/uploads/product_images/{{$jpg->image_name}}" alt=""></div>
                  @endif
                @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
              <h3>{{$products->product_name}}</h3>
              <h2>Rp.{{number_format($products->price)}}</h2>
                <div class="in_stock_container">
                  <span >Availability    :</span>
                  @if ($products->stock <= 0)
                    <span style="color:red;">Out of Stock!</span>
                    @else
                      @if ($products->stock <= 5) 
                      <span style="color:red;">Hurry Up!</span> <br>
                      <span style="color:black;">Only {{$products->stock}} left!</span>
                    @else
                      <span>In Stock</span> <br>
                      <span style="color:black;">{{$products->stock}} left</span>
                    @endif
                          @endif
                </div>
              <p>
                {{$products->description}}
              </p>
          
              <div class="card_area">
                <div class="product_quantity_container">
  <!-- 							@if (is_null(Auth::user()))
                  @if ($products->stock<1)
                    <button class="btn btn-primary btn-success tombol1" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                    <button class="btn btn-primary btn-rounded tombol1" disabled><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                  @else
                    <button class="btn btn-primary btn-success tombol1"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                    <button class="btn btn-primary btn-rounded tombol1"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                  @endif
                @else -->
                  <!-- @if ($products->stock<1)
                    <button class="btn btn-primary btn-success" class="tombol1" disabled>
                      <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> Purchase
                    </button>
                    <button class="btn btn-primary btn-rounded" id="ajaxSubmit" disabled>
                      <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                    </button>
                  @else -->
                  <table>
                  <td>
                  <form action="/checkout" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$products->id}}" id="product_id">
  <!-- 									@if ($harga != 0)
                      <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
                    @else -->
                      <input type="hidden" name="subtotal" id="subtotal" value="{{$products->price}}">
                    <!-- @endif -->
                    <input type="hidden" name="weight" value="{{$products->weight}}">
                    <input type="hidden" name="qty" class="qty" value="1" readonly>
                    <button type="submit" class="btn btn-success" class="tombol1">
                    <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Purchase</button>
                  </form>
                  </td>
                  <td>
                      <input type="hidden" value="{{$products->id}}" id="product_id">
                      <!-- <input type="hidden" value="{{Auth::user()->id}}" id="user_id"> -->
                    <button class="btn btn-primary btn-rounded" id="ajaxSubmit">
                      <i class="fa fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart
                    </button>
                  </td>
                  </table>
                  <!-- @endif -->
                <!-- @endif -->
              </div>
                <a class="icon_btn mt-3" href="#">
                  <i class="lnr lnr lnr-diamond"></i>
                </a>
                <a class="icon_btn" href="#">
                  <i class="lnr lnr lnr-heart"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <span
              class="nav-link active"
              id="review-tab"
              data-toggle="tab"
              href="#review"
              role="tab"
              aria-controls="review"
              aria-selected="false"
              >Reviews</span
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div>
            <div class="row">
              <div class="col-lg-6">
                <div class="row total_rate">
                  <div class="col-6">
                    <div class="box_total">
                      <h5>Overall</h5>
                      <h4>4.0</h4>
                      <h6>(03 Reviews)</h6>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="rating_list">
                      <h3>Based on 3 Reviews</h3>
                      <ul class="list">
                        <li>
                          <a href="#"
                            >5 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >4 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >3 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >2 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >1 Star
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> 01</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="review_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-1.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-2.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="img/product/single-product/review-3.png"
                          alt=""
                        />
                      </div>
                      <div class="media-body">
                        <h4>Blake Ruiz</h4>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                    </div>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->
@endsection