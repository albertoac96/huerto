<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     {!! htmlScriptTagJsApi(['lang' => 'es']) !!}

     <script src="https://www.google.com/recaptcha/api.js" async defer></script>

     <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y5KZH4X0WH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y5KZH4X0WH');
</script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- jQuery -->
  <script src="{{ asset('styles/jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <!-- Bootstrap CSS -->
<link href="{{ asset('styles/bootstrap.css') }}" rel="stylesheet"  type="text/css">

  

   <link href="{{ asset('styles/dataTables.bootstrap5.css') }}" rel="stylesheet"  type="text/css">
    <link href="{{ asset('styles/responsive.bootstrap5.css') }}" rel="stylesheet"  type="text/css">

  <!-- Mis estilos -->
     <link href="{{ asset('styles/sitio/estilos.css') }}" rel="stylesheet"  type="text/css">

   


    <!-- DataTables JS -->

       <script src="{{ asset('styles/dataTables.js') }}"></script>
      <script src="{{ asset('styles/dataTables.bootstrap5.js') }}"></script>
       <script src="{{ asset('styles/dataTables.responsive.js') }}"></script>
        <script src="{{ asset('styles/responsive.bootstrap5.js') }}"></script>


    <!-- Bootstrap JS (incluye Popper JS) -->
    <script src="{{ asset('styles/bootstrap.bundle.js') }}"></script>

         <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      @yield('estilos')



  

       @yield('js')
</head>

<body>

<!-- Overlay -->
<div id="overlay" style="display:none;">
    <div class="loader"></div>
</div>


   @include("admin.main.carga")
        @include("admin.main.nav")

        
        @yield('content')
       

</body>

</html>


<!-- JavaScript para mostrar/ocultar la carga -->
<script>
  function showOverlay() {
    document.getElementById('overlay').style.display = 'flex';
}

window.addEventListener('pageshow', function(event) {
    // Puedes verificar si la página fue cargada desde caché:
    if (event.persisted) {
        // Ocultar el overlay aquí
        document.getElementById('overlay').style.display = 'none';
    }
});


function fechaCorta(psFecha) {
    if (psFecha === "") return "";

    // Extraer la fecha en formato YYYY-MM-DD
    psFecha = psFecha.substring(0, 10);
    const partes = psFecha.split('-');
    let [ano, mes, dia] = partes;

    // Convertir mes de formato numérico a nombre abreviado
    const laMes = ["", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    mes = parseInt(mes, 10);  // asegurarse de que mes sea un entero para usar como índice

    return `${dia} de ${laMes[mes]} ${ano}`;
}


</script>

<style>
#overlay {
    position: fixed; /* Posición fija que cubre toda la pantalla */
    display: flex;
    justify-content: center; /* Centra horizontalmente */
    align-items: center; /* Centra verticalmente */
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
    z-index: 9999; /* Asegura que el overlay está por encima de otros elementos */
}

.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>