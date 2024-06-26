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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('styles/bootstrap.css') }}" rel="stylesheet"  type="text/css">
    <link href="{{ asset('styles/sitio/estilos.css') }}" rel="stylesheet"  type="text/css">
    <script src="{{ asset('styles/bootstrap.bundle.js') }}"></script>
</head>

<body>
   @include("admin.main.carga")
        @include("admin.main.nav")

        
        @yield('content')
       

</body>

</html>


<!-- JavaScript para mostrar/ocultar la carga -->
<script>
    document.getElementById('btnEliminar').addEventListener('click', function () {
        // Mostrar la carga
        document.getElementById('loading-container').style.display = 'flex';
    });

     document.getElementById('btnEditar').addEventListener('click', function () {
        // Mostrar la carga
        document.getElementById('loading-container').style.display = 'flex';
    });
</script>