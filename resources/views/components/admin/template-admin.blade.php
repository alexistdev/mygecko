<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <!-- START:  Header -->
    <x-admin.header-layout />
    <!-- END:  Header -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- START:  NAVBAR -->
    <x-admin.navbar-layout />
    <!-- END:  NAVBAR -->

    <!-- START:  SIDEBAR -->
    <x-admin.sidebar-layout :menu-utama="$menuUtama" :menu-kedua="$menuKedua" />
    <!-- END:  SIDEBAR -->

    <!-- START:  KONTEN -->
    <div class="content-wrapper">
       {{$slot}}
    </div>
    <!-- END:  KONTEN -->

    <!-- START:  FOOTER -->
    <x-admin.footer-layout />
    <!-- END:  FOOTER -->
</div>
<!-- ./wrapper -->


<!-- ChartJS -->
<script src="{{asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('adminlte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminlte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('adminlte/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
</body>
</html>
