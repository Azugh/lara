<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{--
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title') </title>
    {{--
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/img/favicon.ico') }}">

    {{--
    <link href="../layouts/vertical-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('layouts/vertical-dark-menu/css/dark/loader.css') }}">

    {{--
    <link href="../layouts/vertical-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('layouts/vertical-dark-menu/css/light/loader.css') }}">


    {{--
    <script src="../layouts/vertical-dark-menu/loader.js"></script> --}}
    <script src="{{ asset('layouts/vertical-dark-menu/loader.js') }}"></script>


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    {{--
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    {{--
    <link href="../layouts/vertical-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('layouts/vertical-dark-menu/css/light/plugins.css') }}">

    {{--
    <link href="../layouts/vertical-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('layouts/vertical-dark-menu/css/dark/plugins.css') }}">

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    {{--
    <link href="../src/plugins/src/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/src/noUiSlider/nouislider.min.css') }}">

    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    {{--
    <link href="../src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/light/scrollspyNav.css') }}">

    {{--
    <link href="../src/plugins/css/light/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/light/noUiSlider/custom-nouiSlider.css') }}">

    {{--
    <link href="../src/plugins/css/light/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/light/bootstrap-range-Slider/bootstrap-slider.css') }}">

    {{--
    <link href="../src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dark/scrollspyNav.css') }}">

    {{--
    <link href="../src/plugins/css/dark/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/dark/noUiSlider/custom-nouiSlider.css') }}">

    {{--
    <link href="../src/plugins/css/dark/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/dark/bootstrap-range-Slider/bootstrap-slider.css') }}">
    <!--  END CUSTOM STYLE FILE  -->

</head>

<body class="layout-boxed" data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100">

    <!-- BEGIN LOADER -->
    @yield('loader')
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @yield('navbar')
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    @yield('main')
    <!--  END CONTENT AREA  -->

    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{--
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{--
    <script src="../src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script> --}}
    <script src="{{ asset('layouts/vertical-dark-menu/css/dark/perfect-scrollbar.min.js') }}"></script>

    {{--
    <script src="../src/plugins/src/mousetrap/mousetrap.min.js"></script> --}}
    <script src="{{ asset('plugins/src/mousetrap/mousetrap.min.js') }}"></script>

    {{--
    <script src="../layouts/vertical-dark-menu/app.js"></script> --}}
    <script src="{{ asset('layouts/vertical-dark-menu/app.js') }}"></script>

    {{--
    <script src="../src/plugins/src/highlight/highlight.pack.js"></script> --}}
    <script src="{{ asset('plugins/src/highlight/highlight.pack.js') }}"></script>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{--
    <script src="../src/assets/js/scrollspyNav.js"></script> --}}
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>

    {{--
    <script src="../src/plugins/src/noUiSlider/nouislider.min.js"></script> --}}
    <script src="{{ asset('plugins/src/noUiSlider/nouislider.min.js') }}"></script>

    {{--
    <script src="../src/plugins/src/noUiSlider/wNumb.min.js"></script> --}}
    <script src="{{ asset('plugins/src/noUiSlider/wNumb.min.js') }}"></script>

    {{--
    <script src="../src/plugins/src/noUiSlider/custom-nouiSlider.js"></script> --}}
    <script src="{{ asset('plugins/src/noUiSlider/custom-nouiSlider.js') }}"></script>

    {{--
    <script src="../src/plugins/src/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script> --}}
    <script src="{{ asset('plugins/src/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
