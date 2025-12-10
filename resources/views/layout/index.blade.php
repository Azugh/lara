<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
    <title>Hygge</title>
    <!-- Bootstrap core CSS -->

    {{--
    <link href="style/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{--
    <link href="style/css/plugins.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">

    {{--
    <link href="style.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{--
    <link href="style/css/color/green.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/color/green.css') }}">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic'
        rel='stylesheet' type='text/css'>

    <link href="style/type/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('type/icons.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="body-wrapper">

        @include('layout.navbar')

        @include('layout.carousel')
        @include('layout.footer')
    </div>

    {{--
    <script src="style/js/jquery.min.js"></script> --}}
    <script src="js/jquery.min.js"></script>

    <script src="style/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    {{--
    <script src="style/js/plugins.js"></script> --}}
    <script src="js/plugins.js"></script>

    {{--
    <script src="style/js/jquery.themepunch.tools.min.js"></script> --}}
    <script src="js/jquery.themepunch.tools.min.js"></script>

    {{--
    <script src="style/js/scripts.js"></script> --}}
    <script src="js/scripts.js"></script>

</body>