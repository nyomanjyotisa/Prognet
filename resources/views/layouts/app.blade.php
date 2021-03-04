<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
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
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('eiser/css/style.css') }} " />
  <link rel="stylesheet" href="{{ asset('eiser/css/responsive.css') }} " />
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ asset('eiser/js/jquery-3.2.1.min.js') }} "></script>
  <script src="{{ asset('eiser/js/popper.js') }} "></script>
  <script src="{{ asset('eiser/js/bootstrap.min.js') }} "></script>
  <script src="{{ asset('eiser/js/stellar.js') }} "></script>
  <script src="{{ asset('eiser/vendors/lightbox/simpleLightbox.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/nice-select/js/jquery.nice-select.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/isotope/imagesloaded.pkgd.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/isotope/isotope-min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/owl-carousel/owl.carousel.min.js') }} "></script>
  <script src="{{ asset('eiser/js/jquery.ajaxchimp.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/counter-up/jquery.waypoints.min.js') }} "></script>
  <script src="{{ asset('eiser/vendors/counter-up/jquery.counterup.js') }} "></script>
  <script src="{{ asset('eiser/js/mail-script.js') }} "></script>
  <script src="{{ asset('eiser/js/theme.js') }} "></script>
</body>

</html>