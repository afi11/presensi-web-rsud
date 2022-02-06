<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/datatables/datatables.min.css') }}" rel="stylesheet"/>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            <div class="page-content fade-in-up">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datatables/datatables.min.js') }}" type="text/javascript"></script>
    @stack('scripts')
</body>
</html>