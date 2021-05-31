@if ($status == 0)
<div class="products">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="product_grid">
                @foreach ($kategori as $products)
                <!-- Product -->
                <div class="product">
                    @foreach ($products->product_image as $image)
                    <div class="product_image"><img style="width:250px;height:250px;" src="/uploads/product_images/{{$image->image_name}}" alt=""></div>
                        @break
                    @endforeach
                    @php
                        $home = new Home;
                        $disc = $home->tampildiskon($products->discount);
                    @endphp
                    @if($disc!=0)
                        <div style="background-color:red;"class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
                    @endif
                        <div class="product_content">
                        <div class="product_title"><a href="/product/{{$products->id}}">{{$products->product_name}}</a></div>
                        <span class="badge badge-primary mb-2">Rating: {{$products->product_rate}} <i class="fa fa-star"></i></span>
						@if ($products->stock == 0)
							<span class="badge badge-danger mb-2">Out Of Stock!</span>
						@endif
                    @php
                        $home = new Home;
                        $harga = $home->diskon($products->discount,$products->price);
                    @endphp
                    @if ($harga != 0)	   
                        <div style="text-decoration:line-through;" class="product_price">Rp.{{number_format($products->price)}}</div>
                        <div style="font-weight:bold;color:black;" class="product_price">Rp.{{number_format($harga)}}</div>
                    @else
                    <div class="product_price">Rp.{{number_format($products->price)}}</div>
                    @endif
                </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset('assets/User/js/custom.js')  }}"></script>
@else
<div class="products">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="product_grid">
                @foreach ($kategori->product as $products)
                <!-- Product -->
                <div class="product">
                    @foreach ($products->product_image as $image)
                    <div class="product_image"><img style="width:250px;height:250px;" src="/uploads/product_images/{{$image->image_name}}" alt=""></div>
                        @break
                    @endforeach
                    @php
                        $home = new Home;
                        $disc = $home->tampildiskon($products->discount);
                    @endphp
                    @if($disc!=0)
                        <div style="background-color:red;"class="product_extra product_new"><a href="categories.html">-{{$disc}}%</a></div>
                    @endif
                        <div class="product_content">
                        <div class="product_title"><a href="/product/{{$products->id}}">{{$products->product_name}}</a></div>
                        <span class="badge badge-primary mb-2">Rating: {{$products->product_rate}} <i class="fa fa-star"></i></span>
						@if ($products->stock == 0)
						<span class="badge badge-danger mb-2">Out Of Stock!</span>
						@endif
                    @php
                        $home = new Home;
                        $harga = $home->diskon($products->discount,$products->price);
                    @endphp
                    @if ($harga != 0)	   
                        <div style="text-decoration:line-through;" class="product_price">Rp.{{number_format($products->price)}}</div>
                        <div style="font-weight:bold;color:black;" class="product_price">Rp.{{number_format($harga)}}</div>
                    @else
                    <div class="product_price">Rp.{{number_format($products->price)}}</div>
                    @endif
                </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset('assets/User/js/custom.js')}}"></script>
@endif