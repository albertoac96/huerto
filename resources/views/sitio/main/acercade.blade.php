<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="../styles/bootstrap.css" rel="stylesheet"  type="text/css">
    <link href="../styles/sitio/estilos.css" rel="stylesheet"  type="text/css">
    <script src="../styles/bootstrap.bundle.js"></script>
</head>
<body>
   
        @include("sitio.main.navbar")

        
        @yield('content')
       

        @include("sitio.main.sitiosrel", ['sitiosrel'])
        @include("sitio.main.footer")
</body>
</html>