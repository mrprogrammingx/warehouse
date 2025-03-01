
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet"/>
    <link href="{{asset('fonts/font-awesome/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{asset('fonts/font-awesome/css/solid.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css') }}">
    <link rel="stylesheet" href="{{asset('css/main2.css') }}">
    <link rel="stylesheet" href="{{asset('css/dash_2.css') }}">
    <link rel="stylesheet" href="{{asset('css/structure.css') }}">

{{--    <!-- Scripts -->--}}
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="{{ asset('js/app2.js') }}"></script>

</head>
<body class="alt-menu sidebar-noneoverflow">
<div class="wrapper" id="app">
    <div class="main-panel h-100">
        <div class="content h-100">
            <menubar></menubar>
            <AppComponent></AppComponent>

        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        App.init();
    });
</script>

</body>
</html>
