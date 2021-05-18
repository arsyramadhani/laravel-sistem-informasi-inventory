<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/dist/img/web/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/dist/img/web/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/dist/img/web/favicon/favicon-16x16.png">
    <link rel="manifest" href="/dist/img/web/favicon/site.webmanifest">

    <title>@yield('title') | {{str_replace('_', ' ',env('STORE_NAME'))}}</title>

    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.css">
    @stack('style')
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>

<body class="sidebar-mini layout-fixed  ">
    <div class="wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')

        <div class="content-wrapper p-3">
            <div class="content-header mt-n2">
                <div class="container-fluid">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                            <h4 class="m-0 text-dark font-weight-bold ">@yield('title')</h4>
                        </div>
                    </div><hr>
                    </div>
            </div>
            <div class="content mt-n3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

        <script src="/plugins/jquery/jquery.min.js"></script>
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/dist/js/adminlte.min.js"></script>
        <script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
         @include('sweetalert::alert')
        <script src="{{asset('/plugins/jquery-validation/jquery.validate.js')}}"></script>
        <script src="{{asset('/plugins/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        </script>
@stack('scripts')
</body>

</html>
