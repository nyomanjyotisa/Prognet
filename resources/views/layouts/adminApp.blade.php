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
    @include('layouts.adminnavbar')
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


<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="chit-chat-layer1"></div>
<div class="inner-block">
<!--market updates updates-->
<div class="container-fluid page-body-wrapper">
        @include('layouts.adminSidebar')
	@yield('content')
</div>	
</div>

<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1"></div>
<!--main page chit chating end here-->
<!--main page chart start here-->
</div>
<!--inner block end here-->
<!--copy rights start here-->
<!--COPY rights end here-->
</div>
<!--scrolling js-->
<script src="{{ asset('assets/Admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('assets/Admin/js/scripts.js')}}"></script>
<!--//scrolling js-->
<script src="{{ asset('assets/Admin/js/bootstrap.js')}}"> </script>
<script>
$('#tombol').click(function(e){
    e.preventDefault();
    $('#modalContactForm').modal();
});
</script>
<script>
	$(document).ready(function(e){
		$(".status").click(function(e){
			var index = $(".status").index(this);
			var myStatus = '';
			console.log(index);
			switch(index){
			  case 0:
				  myStatus = 'all';
				  break;
			  case 1:
				  myStatus = 'unverified';
				  break;
			  case 2:
				  myStatus = 'waiting';
				  break;
			  case 3:
				  myStatus = 'verified';
				  break;
			  case 4:
				  myStatus = 'delivered';
				  break;
			  case 5:
				  myStatus = 'success';
				  break;
			  case 6:
				  myStatus = 'canceled';
				  break;
  
			}
  
			console.log(myStatus);
		  jQuery.ajax({
				url: "{{url('/admin/transaksi/sort')}}",
				method: 'post',
				data: {
					_token: $('#signup-token').val(),
					status: myStatus,
				},
				success: function(result){
				  $('.ganti').html(result.hasil);
				}
			});
		});
	  });
  </script>
  <script>
    window.onload = function () {
    
    var options = {
        axisX: {
            interval:1,
            labelMaxWidth: 180,           
            labelAngle: -45,
            labelFontFamily:"Times New Roman"
        },
        title: {
            text: "Grafik Jumlah Transaksi Perbulan {{date('Y')}}"              
        },
        data: [              
        {
            type: "column",
            dataPoints: [
                { label: "Januari",  y: parseInt($('#bulan1').val())},
                { label: "Februari", y: parseInt($('#bulan2').val())},
                { label: "Maret", y: parseInt($('#bulan3').val())},
                { label: "April", y: parseInt($('#bulan4').val())},
                { label: "Mei",  y: parseInt($('#bulan5').val())},
                { label: "Juni",  y: parseInt($('#bulan6').val())},
                { label: "Juli",  y: parseInt($('#bulan7').val())},
                { label: "Agustus", y: parseInt($('#bulan8').val())},
                { label: "September", y: parseInt($('#bulan9').val())},
                { label: "Oktober",  y: parseInt($('#bulan10').val())},
                { label: "November",  y: parseInt($('#bulan11').val())},
                { label: "Desember",  y: parseInt($('#bulan12').val())},
            ]
        }
        ]
    };
    
    $("#chartContainer").CanvasJSChart(options);
    }
</script>    


    <script>
    function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
	}

    function creteChart(tahun, ttlTahun, judul = ''){
        var options = {
                            axisX: {
                                interval:1,
                                labelMaxWidth: 180,           
                                labelAngle: -45,
                                labelFontFamily:"Times New Roman"
                            },
                            title: {
                                text: "Grafik Jumlah Transaksi "+judul+" Perbulan "+ttlTahun              
                            },
                            data: [              
                            {
                                type: "column",
                                dataPoints: [
                                    { label: "Januari",  y: tahun[1]},
                                    { label: "Februari", y: tahun[2]},
                                    { label: "Maret", y: tahun[3]},
                                    { label: "April", y: tahun[4]},
                                    { label: "Mei",  y: tahun[5]},
                                    { label: "Juni",  y: tahun[6]},
                                    { label: "Juli",  y: tahun[7]},
                                    { label: "Agustus", y: tahun[8]},
                                    { label: "September", y: tahun[9]},
                                    { label: "Oktober",  y: tahun[10]},
                                    { label: "November",  y: tahun[11]},
                                    { label: "Desember",  y: tahun[12]},
                                    
                                ]
                            }
                            ]
                        };
                        
                        $("#chartContainer").CanvasJSChart(options);
    }
      jQuery(document).ready(function(e){
          console.log($('#bulan1').val())
          jQuery('#bulan').change(function(e){
                jQuery.ajax({
                    url: "{{url('/report-bulan')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        bulan: $('#bulan').val(),
                        tahun: $('#tahun').val(),
                    },
                    success: function(result){
                        $('#total').text(result.data['total']);
                        $('#unverified').text(result.data['unverified']);
                        $('#expired').text(result.data['expired']);
                        $('#canceled').text(result.data['canceled']);
                        $('#verified').text(result.data['verified']);
                        $('#delivered').text(result.data['delivered']);
                        $('#success').text(result.data['success']);
                        var uang = formatRupiah(result.data['harga'],'Rp ');
                        $('#harga').text(uang);
                    }
                });
          });

          jQuery('#tahun').change(function(e){
                jQuery.ajax({
                    url: "{{url('/report-tahun')}}",
                    method: 'post',
                    data: {
                        _token: $('#signup-token').val(),
                        bulan: $('#bulan').val(),
                        tahun: $('#tahun').val(),
                    },
                    success: function(result){
                        $('#total').text(result.data_bulan['total']);
                        $('#unverified').text(result.data_bulan['unverified']);
                        $('#expired').text(result.data_bulan['expired']);
                        $('#canceled').text(result.data_bulan['canceled']);
                        $('#verified').text(result.data_bulan['verified']);
                        $('#delivered').text(result.data_bulan['delivered']);
                        $('#success').text(result.data_bulan['success']);
                        var uang = formatRupiah(result.data_bulan['harga'],'Rp ');
                        $('#harga').text(uang);

                        $('#total-tahun').text(result.data['total']);
                        $('#unverified-tahun').text(result.data['unverified']);
                        $('#expired-tahun').text(result.data['expired']);
                        $('#canceled-tahun').text(result.data['canceled']);
                        $('#verified-tahun').text(result.data['verified']);
                        $('#delivered-tahun').text(result.data['delivered']);
                        $('#success-tahun').text(result.data['success']);
                        var uang_tahun = formatRupiah(result.data['harga'],'Rp ');
                        $('#harga-tahun').text(uang_tahun);
                        
                        creteChart(result.tahun, $('#tahun').val());
                    }

                });
          });

          $(".status").click(function(e){
            var index = $(".status").index(this);
            var myStatus = '';
            switch(index){
                case 0:
                    myStatus = 'all';
                    break;
                case 1:
                    myStatus = 'unverified';
                    break;
                case 2:
                    myStatus = 'expired';
                    break;
                case 3:
                    myStatus = 'verified';
                    break;
                case 4:
                    myStatus = 'delivered';
                    break;
                case 5:
                    myStatus = 'success';
                    break;
                case 6:
                    myStatus = 'canceled';
                    break;

            }
            jQuery.ajax({
                url: "{{url('/grafik')}}",
                method: 'post',
                data: {
                    _token: $('#signup-token').val(),
                    status: myStatus,
                    tahun: $('#tahun').val(),
                },
                success: function(result){
                    creteChart(result.grafik, $('#tahun').val(), myStatus);
                }
            });
        });

      });
    </script>
<!-- mother grid end here-->
    
</body>
</html>

