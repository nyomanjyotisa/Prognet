<header class="header_area">
  <div class="top_menu">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="float-left">
            <p>Phone: +01 256 25 235</p>
            <p>email: info@eiser.com</p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="float-right">
            <ul class="right_side">
              <li>
                <a href="#">
                  gift card
                </a>
              </li>
              <li>
                <a href="#">
                  track order
                </a>
              </li>
              <li>
                <a href="#">
                  Contact Us
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main_menu">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light w-100">
        <a class="navbar-brand logo_h" href="/">
          <!-- <img src="{{ asset('eiser/img/logo.png') }} " alt="" /> -->
          <h2>Gadget<span style="color:#71cd14">IT</span></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
          <div class="row w-100 mr-0">
            <div class="col-lg-7 pr-0">
              <ul class="nav navbar-nav center_nav pull-right">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item submenu dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">Shop</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Shop Category</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Product Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Product Checkout</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/cart">Shopping Cart</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item submenu dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">Blog</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Blog Details</a>
                    </li>
                  </ul>
                </li>
                @guest
                <li class="nav-item submenu dropdown">
                  <a class="nav-link" href="/login">Login</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/transaksi/{{Auth::user()->id}}">Transaction</a>
                </li>
                <li class="nav-item submenu dropdown">
                    <a class="dropdown-item nav-link" href="{{ url('/user/logout') }}"
										   onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
                    <form id="logout-form"  action="{{ url('/user/logout') }}" method="GET" style="display: none;">
											@csrf
										</form>
								</li>
                @endguest
              </ul>
            </div>

            <div class="col-lg-5 pr-0">
              <ul class="nav navbar-nav navbar-right right_nav pull-right">
                <li class="nav-item">
                  <a href="#" class="icons">
                    <i class="ti-search" aria-hidden="true"></i>
                  </a>
                </li>

                @auth
								<li class="hassubs active">
									<?php 
                  $id = Auth::user()->id;
                  $notif_count = Auth()->user()->unreadNotifications->count();
                  $notifications = DB::table('user_notifications')->where('notifiable_id',$id)->where('read_at',NULL)->orderBy('created_at','desc')->get();
                  ?>
									<a href="/home" class="icons"><i class="fa fa-bell-o"><span class="badge badge-pill badge-danger">{{$notif_count}}</span></i></a>
									<ul >
										<center><a href="/marknotif" class="btn" style="background-color: white;">Mark All As Read</a></center>
										@foreach($notifications as $notif)
											<li>{!!$notif->data!!}</li>
											<br>
										@endforeach                                  
									</ul>
								</li>
								@endauth

                <li class="nav-item">
                  @auth
                  <a href="/cart" class="icons">
                    <i class="ti-shopping-cart"><span class="badge badge-pill badge-info" id="jumlahcart">{{Auth::user()->cart->where('status','=','notyet')->count()}}</span></i>
                  </a>
                  @endauth
                </li>

                <li class="nav-item">
                  <a href="#" class="icons">
                    <i class="ti-user" aria-hidden="true"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>