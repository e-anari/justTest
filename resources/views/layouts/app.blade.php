<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/website-theme/images/favicon.ico" type="image/ico" />

  <title>{{config('app.name')}} </title>

  <!-- Bootstrap -->
  <link href="/website-theme/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/website-theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="/website-theme/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="/website-theme/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="/website-theme/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="/website-theme/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="/website-theme/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Added BY Me -->
  <link href="/website-theme/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Custom Theme Style -->
  <link href="/website-theme/build/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-heart"></i> <span>Laravel Sample</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- sidebar menu -->
          @include('layouts.sidebar')
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      @include('layouts.navbar')
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        @include('layouts.flash-message')
        @yield('content')
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Sample project by <a href="">E.Anari</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>


  <!-- jQuery -->
  <script src="/website-theme/vendors/jquery/dist/jquery.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}


  <!-- Bootstrap -->
  <script src="/website-theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script src="/website-theme/vendors/select2/dist/js/select2.min.js"></script>

  <!-- FastClick -->
  <script src="/website-theme/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="/website-theme/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="/website-theme/vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="/website-theme/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="/website-theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="/website-theme/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="/website-theme/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="/website-theme/vendors/Flot/jquery.flot.js"></script>
  <script src="/website-theme/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="/website-theme/vendors/Flot/jquery.flot.time.js"></script>
  <script src="/website-theme/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="/website-theme/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="/website-theme/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="/website-theme/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="/website-theme/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="/website-theme/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="/website-theme/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="/website-theme/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="/website-theme/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="/website-theme/vendors/moment/min/moment.min.js"></script>
  <script src="/website-theme/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Added By Me -->

  <!-- Custom Theme Scripts -->
  <script src="/website-theme/build/js/custom.min.js"></script>

  <!-- Scripts -->
  @yield('scripts')

</body>

</html>