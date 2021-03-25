<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>GadgetIT</title>
  <link rel="stylesheet" href="{{ asset('eiser/css/bootstrap.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/linericon/style.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/font-awesome.min.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/themify-icons.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/flaticon.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/owl-carousel/owl.carousel.min.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/lightbox/simpleLightbox.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/nice-select/css/nice-select.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/animate-css/animate.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/vendors/jquery-ui/jquery-ui.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/style.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/responsive.css') }} " />
  <link rel="stylesheet" type="text/css" href="{{ asset('user/product.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('user/product_responsive.css')}}">
  <style>
    .checked {
      color: orange;
    }
  </style>
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

  <script src="{{ asset('eiser/js/jquery-3.2.1.min.js') }} "></script>
  <!-- <script src="{{ asset ('assets/User/js/jquery-3.2.1.min.js')}}"></script> -->
  <script src="{{ asset('eiser/js/popper.js') }} "></script>
  <script src="{{ asset('eiser/js/bootstrap.min.js') }} "></script>
  <script src="{{ asset('eiser/js/stellar.js') }} "></script>
  <script src="{{ asset('eiser/vendors/lightbox/simpleLightbox.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/nice-select/js/jquery.nice-select.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/isotope/imagesloaded.pkgd.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/isotope/isotope-min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/owl-carousel/owl.carousel.min.js') }} "></script>
  <!-- <script src="{{ asset('eiser/js/jquery.ajaxchimp.min.js') }} "></script> -->
  <script src="{{ asset('eiser/vendors/counter-up/jquery.waypoints.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/counter-up/jquery.counterup.js') }} "></script>
  <script src="{{ asset('eiser/js/mail-script.js') }} "></script>
  <script src="{{ asset('eiser/js/theme.js') }} "></script>
  <script src="{{ asset('user/product.js')  }}"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>

  @yield('script')
</body>

</html>