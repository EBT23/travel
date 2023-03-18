<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote-django/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Feb 2023 01:54:17 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Starter Page | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.css') }}">

</head>

<body data-sidebar="dark" data-layout-mode="light">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('layouts.navbar')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-wrapper">
            @yield('content')
        </div>


        <!-- end main content-->
        @include('layouts.footer')
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.rightbar')
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- data table --}}
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/libs/%40chenfengyuan/datepicker/datepicker.min.js') }}"></script>
    {{-- end datatables --}}

</body>

<!-- Mirrored from themesbrand.com/skote-django/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Feb 2023 01:54:17 GMT -->
</html>