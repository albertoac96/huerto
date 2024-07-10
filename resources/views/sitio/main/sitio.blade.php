<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     {!! htmlScriptTagJsApi(['lang' => 'es']) !!}

     <meta name="google-site-verification" content="qf_OU3fxoh8Ue1FIqfbeCfIXZtzjaJbl8dQEnCXc75I" />

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

  <link href="../styles/bootstrap.css" rel="stylesheet"  type="text/css">
    <link href="../styles/sitio/estilos.css" rel="stylesheet"  type="text/css">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Importa la fuente de Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">


  
    <script src="../styles/bootstrap.bundle.js"></script>

     <script language="javascript" src="../styles/scripts1.js"></script>
<link rel="stylesheet" href="../styles/estilosCatalogo.css">

<script src="https://kit.fontawesome.com/e31d27d23f.js" crossorigin="anonymous"></script>


    <script async src="https://www.google.com/recaptcha/api.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


 @yield('js')


      @yield('estilos')



</head>



<body>

<div id="loading-overlay">
  <div class="spinner"></div>
</div>

   <img class="img-top-left" src="../images/fondo_hojas.png" width="280px">

        @include("sitio.main.navbar")

        
        @yield('content')
       

        @include("sitio.main.sitiosrel", ['sitiosrel'])
        @include("sitio.main.footer")





</body>

</html>



<style>
#loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  z-index: 9999;
  display: none;
}

.spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 40px;
  height: 40px;
  border: 4px solid #fff;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}


.image-container {
    width: 100%; /* Ajusta el ancho al tamaño deseado */
    height: 300px; /* Ajusta la altura al tamaño deseado */
    overflow: hidden; /* Oculta la parte de la imagen que se salga del contenedor */
    border: 0;
    border-top-left-radius: 3em;
    border-bottom-right-radius: 5em;
}
.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Mantiene las proporciones de la imagen y la recorta para llenar el contenedor */
    object-position: center; /* Centra la imagen dentro del contenedor */
}






@keyframes spin {
  to {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
</style>

