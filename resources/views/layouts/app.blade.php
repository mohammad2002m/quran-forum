<html dir="rtl" lang="ar" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
    

    @yield('head')
</head>

<body>

    <x-top-bar />
    <x-nav-bar />

    <!-- main container is not used in anything yet -->
    <div class="main-container">
        @yield('content')
    </div>
    
    @yield('scripts')

</body>

<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</html>
