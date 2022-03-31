<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Prenez en main la gestion de votre établisement scolaire') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset("css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/mobility.css?v=".time())}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/animate.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/style.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/connexion.css") }}" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="{{ asset("images/favicon-mobility-cloud.png") }}" />

</head>
<body ng-app="Mobility" style="background-image: url({{ asset('images/bg-3.jpg') }}) !important; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; -webkit-background-size: cover; background-size: cover;">
    <div id="app">
        <div id="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app-lte.js') }}"></script>

    @yield('dataTablesJS')
    @yield('ChartJS')
    @yield('datePickerJS')
    @yield('select2JS')
    @yield('mobJS')
    @yield('jsL')

    <script src="{{ asset('js/animate.js') }}"></script>

</body>

</html>
