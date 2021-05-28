@extends('layouts.adminApp')

@section('content')
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">halo123123123</h3>
            <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="market-updates">
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-1">
			<div class="col-md-8 market-update-left">
				<h3>{{ \App\User::all()->count() }}</h3>
				<h4>Registered User</h4>
				<a href="#" style="color:white; text-decoration: underline">See detail</a>
			</div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-file-text-o"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-2">
		 <div class="col-md-8 market-update-left">
			<h3>{{ \App\Transaction::all()->count() }}</h3>
			<h4>Transaction</h4>
			<p>Other hand, we denounce</p>
		  </div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-eye"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
	<div class="col-md-4 market-update-gd">
		<div class="market-update-block clr-block-3">
			<div class="col-md-8 market-update-left">
				<h3>{{ \App\Product::all()->count() }}</h3>
				<h4>Active Product</h4>
				<p>Other hand, we denounce</p>
			</div>
			<div class="col-md-4 market-update-right">
				<i class="fa fa-envelope-o"> </i>
			</div>
		  <div class="clearfix"> </div>
		</div>
	</div>
   <div class="clearfix"> </div>
</div>
<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1"></div>
<!--main page chit chating end here-->
<!--main page chart start here-->
<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
<div class="row">
    <div class="col-md-6 market-update-gd">
      <div class="market-update-block clr-block-3">
        <div class="card-body">
		  <h4 class="font-weight-normal mb-3">Transaksi Bulan 
			  <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
		  <select name="bulan" id="bulan" style="
            margin-bottom: 1em;
            padding: .25em;
            border: 0;
            font-weight: bold;
            letter-spacing: .15em;
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-radius: 0;
            &:focus, &:active {
              outline: 0;
              border-bottom-color: red;
              color: black;
            }
          ">
              <option value="1" style="color:black" @if (date('m') == 1)
                  selected
              @endif>Januari</option>
              <option value="2" style="color:black"  @if (date('m') == 2)
              selected
          @endif>Februari</option>
              <option value="3" style="color:black"  @if (date('m') == 3)
              selected
          @endif>Maret</option>
              <option value="4" style="color:black"  @if (date('m') == 4)
              selected
          @endif>April</option>
              <option value="5" style="color:black"  @if (date('m') == 5)
              selected
          @endif>Mei</option>
              <option value="6" style="color:black"  @if (date('m') == 6)
              selected
          @endif>Juni</option>
              <option value="7" style="color:black"  @if (date('m') == 7)
              selected
          @endif>Juli</option>
              <option value="8" style="color:black"  @if (date('m') == 8)
              selected
          @endif>Agustus</option>
              <option value="9" style="color:black"  @if (date('m') == 9)
              selected
          @endif>September</option>
              <option value="10" style="color:black"  @if (date('m') == 10)
              selected
          @endif>Oktober</option>
              <option value="11" style="color:black"  @if (date('m') == 11)
              selected
          @endif>November</option>
              <option value="12" style="color:black"  @if (date('m') == 12)
              selected
          @endif>Desember</option>
          </select>
          </h4>
          @php
              setlocale(LC_MONETARY,"id_ID");
          @endphp
          <h2 class="mb-2">Jumlah Transaksi: <span><strong id="total">{{$status['total']}}</strong></span></h2>
          <p>Unverified Transaction <span> <strong id="unverified">{{$status['unverified']}}</strong></span></p>
          <p>Expired Transaction <span><strong id="expired">{{$status['expired']}}</strong></span></p>
          <p>Canceled Transaction <span><strong id="canceled">{{$status['canceled']}}</strong></span></p>
          <p>Verified Transaction <span><strong id="verified">{{$status['verified']}}</strong></span></p>
          <p>Delivered Transaction <span><strong id="delivered">{{$status['delivered']}}</strong></span></p>
          <p>Success Transaction <span><strong id="success">{{$status['success']}}</strong></span></p>
          <h4>Total Penghasilan <span><strong id="harga">Rp {{number_format($status['harga'],0,',','.')}}</strong></span></h4>
        </div>
      </div>
	</div>
	<div class="col-md-6 market-update-gd">
		<div class="market-update-block clr-block-3">
		  <div class="card-body">
			<h4 class="font-weight-normal mb-3">Transaksi Tahun <select name="tahun" id="tahun" style="
			  margin-bottom: 1em;
			  padding: .25em;
			  border: 0;
			  font-weight: bold;
			  letter-spacing: .15em;
			  color: white;
			  background-color: rgba(255,255,255,0.1);
			  border-radius: 0;
			  &:focus, &:active {
				outline: 0;
				border-bottom-color: red;
				color: black;
			  }
			">
			@for ($i = 2019; $i <= date('Y'); $i++)
				<option value="{{$i}}" @if ($i == date('Y'))
					selected
				@endif style="color:black">{{$i}}</option>
			@endfor
			</select> <i class="mdi mdi-diamond mdi-24px float-right"></i>
			</h4>
			<h2 class="mb-2">Jumlah Transaksi: <span><strong id="total-tahun">{{$transaksi_tahun->count()}}</strong></span></h2>
			<p>Unverified Transaction <span> <strong id="unverified-tahun">{{$status_tahun['unverified']}}</strong></span></p>
			<p>Expired Transaction <span><strong id="expired-tahun">{{$status_tahun['expired']}}</strong></span></p>
			<p>Canceled Transaction <span><strong id="canceled-tahun">{{$status_tahun['canceled']}}</strong></span></p>
			<p>Verified Transaction <span><strong id="verified-tahun">{{$status_tahun['verified']}}</strong></span></p>
			<p>Delivered Transaction <span><strong id="delivered-tahun">{{$status_tahun['delivered']}}</strong></span></p>
			<p>Success Transaction <span><strong id="success-tahun">{{$status_tahun['success']}}</strong></span></p>
			<h4>Total Penghasilan <span><strong id="harga-tahun">Rp {{number_format($status_tahun['harga'],0,',','.')}}</strong></span></h4>
		  </div>
		</div>
	  </div>
	</div>
	@for ($i = 1; $i <= 12; $i++)
		<input type="hidden" id='bulan{{$i}}' value="{{$bulan[$i]}}">
	@endfor
	<br><br>
	  <div class="d-flex flex-row bd-highlight mb-3">
		  <div class="col-md-3 grid-margin stretch-card">
			  <div class="card">
				  <div class="card-body">
						  <h4 class="card-title">Transaction Type</h4>
						  <br>
						  <div class="btn-group-vertical">
							  <button class="btn btn-primary status" id="all">All</button>
							  <button class="btn btn-primary status" id="unverified">Unverivied</button>
							  <button class="btn btn-primary status" id="expired">Expired</button>
							  <button class="btn btn-primary status" id="verified">Verified</button>
							  <button class="btn btn-primary status" id="delivered">Delivered</button>
							  <button class="btn btn-primary status" id="success">Success</button>
							  <button class="btn btn-primary status" id="canceled">Canceled</button>
						  </div>
				  </div> 
			  </div>
		   </div>   
		   <div class="col-md-9 grid-margin stretch-card"> 
			<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
			<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
			   <div class="card">
				  <div class="card-body">
					  <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
				  </div>
			  </div> 
		  </div> 
	  </div>





    <!-- <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
          <div class="card-people mt-auto">
            <img src="{{ asset('template/images/dashboard/people.svg') }}" alt="people">
            <div class="weather-info">
              <div class="d-flex">
                <div>
                  <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                </div>
                <div class="ml-2">
                  <h4 class="location font-weight-normal">Bangalore</h4>
                  <h6 class="font-weight-normal">India</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Today’s Bookings</p>
                <p class="fs-30 mb-2">4006</p>
                <p>10.00% (30 days)</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Total Bookings</p>
                <p class="fs-30 mb-2">61344</p>
                <p>22.00% (30 days)</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Number of Meetings</p>
                <p class="fs-30 mb-2">34040</p>
                <p>2.00% (30 days)</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Number of Clients</p>
                <p class="fs-30 mb-2">47033</p>
                <p>0.22% (30 days)</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Order Details</p>
            <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
            <div class="d-flex flex-wrap mb-5">
              <div class="mr-5 mt-3">
                <p class="text-muted">Order value</p>
                <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
              </div>
              <div class="mr-5 mt-3">
                <p class="text-muted">Orders</p>
                <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
              </div>
              <div class="mr-5 mt-3">
                <p class="text-muted">Users</p>
                <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
              </div>
              <div class="mt-3">
                <p class="text-muted">Downloads</p>
                <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
              </div> 
            </div>
            <canvas id="order-chart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
            <p class="card-title">Sales Report</p>
            <a href="#" class="text-info">View all</a>
            </div>
            <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
            <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
            <canvas id="sales-chart"></canvas>
          </div>
        </div>
      </div>
    </div>
    </div> -->
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->

<!-- page-body-wrapper ends -->
@endsection