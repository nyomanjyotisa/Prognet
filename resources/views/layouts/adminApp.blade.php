<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <link rel="stylesheet" href="{{ asset('template/vendors/feather/feather.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/vendors/ti-icons/css/themify-icons.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/vendors/css/vendor.bundle.base.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/vendors/ti-icons/css/themify-icons.css') }} ">
  <link rel="stylesheet" type="text/css" href="{{ asset('template/js/select.dataTables.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/style.css') }} ">
  <link rel="shortcut icon" href="{{ asset('template/images/favicon.png') }} " />
</head>
<body>
  <div class="container-scroller"> 
    @include('layouts.adminNavbar')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.adminSidebar')
        @yield('content')
        @include('layouts.adminFooter')
    </div>
  </div>

  <script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }} "></script>
  <script src="{{ asset('template/vendors/chart.js/Chart.min.js') }} "></script>
  <script src="{{ asset('template/vendors/datatables.net/jquery.dataTables.js') }} "></script>
  <script src="{{ asset('template/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }} "></script>
  <script src="{{ asset('template/js/dataTables.select.min.js') }} "></script>
  <script src="{{ asset('template/js/off-canvas.js') }} "></script>
  <script src="{{ asset('template/js/hoverable-collapse.js') }} "></script>
  <script src="{{ asset('template/js/template.js') }} "></script>
  <script src="{{ asset('template/js/settings.js') }} "></script>
  <script src="{{ asset('template/js/todolist.js') }} "></script>
  <script src="{{ asset('template/js/dashboard.js') }} "></script>
  <script src="{{ asset('template/js/Chart.roundedBarCharts.js') }} "></script>
</body>
</html>

