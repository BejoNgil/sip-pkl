<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <title>@yield('title') {{ config('app.name', 'SIP-PKL') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Bootstrap Styles-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/checkbox3.min.css') }}" rel="stylesheet">
    <!-- Custom Styles-->
    <link href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    @stack('style')
</head>

<body class="@yield('body')">
    <div id="wrapper">
        @yield('content')
    </div>
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Metis Menu Js -->
    <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('assets/js/custom-scripts.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')

    @if(session()->has('success'))
    <script>
        swal("Berhasil", '{{ session()->get('success') }}', "success");
    </script>
    @endif
    @if(session()->has('error'))
    <script>
        swal("Oops!", '{{ session()->get('error') }}', "error");
    </script>
    @endif
    @if(session()->has('warning'))
    <script>
        swal("Perhatian!", '{{ session()->get('warning') }}', "warning");
    </script>
    @endif
</body>

</html>
