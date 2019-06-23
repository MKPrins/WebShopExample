<html>
<head>
    <title>Webshop</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/order.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/product.css') }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @stack('scripts')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="app-container">

    @include('layouts.header')
    @include('layouts.menu')

    <div class="main-content">

        @yield('content')

    </div>

</div>

</body>
</html>