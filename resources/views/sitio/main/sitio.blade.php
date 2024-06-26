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
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Importa la fuente de Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&display=swap">


    <link href="../styles/bootstrap.css" rel="stylesheet"  type="text/css">
    <link href="../styles/sitio/estilos.css" rel="stylesheet"  type="text/css">
    <script src="../styles/bootstrap.bundle.js"></script>

     <script language="javascript" src="../styles/scripts1.js"></script>
<link rel="stylesheet" href="../styles/estilosCatalogo.css">

<script src="https://kit.fontawesome.com/e31d27d23f.js" crossorigin="anonymous"></script>


    <script async src="https://www.google.com/recaptcha/api.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



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


        <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-height:300px" >
    <div class="modal-content" style="border-top-right-radius:3em;border-bottom-left-radius:3em;background-color: #F2E4C5">
      <div class="modal-header text-center" style="border-bottom: 2px solid #3F533A;">
        <h5 class="modal-title texttitle" id="tituloCama"></h5>
        <button type="button" class="btn-close" style="color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body m-5">
     
         <label id="infoModal"></label>
       
      </div>
      
    </div>
  </div>
</div>



</body>

</html>


<script>
$(document).ready(function() {
    $('g').filter(function() {
  return $(this).attr('data-value') ;
}).click(function() {
  
    $('#loading-overlay').show();
    var modalBody = "";
     $('#infoModal').html(modalBody);
    var value = $(this).attr("data-value");
    if(value === undefined){
        return;
    }
    console.log(value);
    let title = 'Cama ' + value;
    $('#tituloCama').text(title);
    $.ajax({
      url: "catalogo/infoCama/"+value,
      method: "GET",
      success: function(response) {
        $('#modal').modal('show');
        console.log(response);
        $('#loading-overlay').hide();
        
        modalBody = '<p><b>Experimento(s):</b> ';
        if(response.exps.length == 0 || response.exps[0].idExperimento == null){
            modalBody += 'Sin experimentos';
        } else {
            response.exps.forEach(function(exp) {
                modalBody += `${exp.cExperimento}`;
            });
        }
        modalBody += "</p>";

        modalBody += '<p><b>Encargado(s):</b> ';
        if(response.user.length == 0 || response.user[0].nombre == null){
            modalBody += 'Sin encargado';
        }else{
            response.user.forEach(function(us) {
                modalBody += `<a href="${us.cLink}" target="_blank" style="color:black;">${us.nombre} `;
                modalBody += `${us.apellido} </a>`;
            });
        }
        modalBody += "</p>";

        modalBody += '<p><b>Planta(s):</b> ';
        if(response.plantas.length == 0 || response.plantas[0].idPlanta == null){
             modalBody += 'Sin plantas';
        }else{
             modalBody += '<div class="row row-cols-3">';
             response.plantas.forEach(function(planta) {
                modalBody += '<div class="col"><div class="img-circle mt-2">';
                modalBody += `<img src="../images/content/catalogo/${planta.idPlanta}.${planta.cExt}" class="img-fluid rounded-circle" alt="..."></div>`
                modalBody += `<center><a class="textcard2" href="planta/${planta.idPlanta}">${planta.cNombre}</a></center></div>`
            });
            modalBody += "</div>";
        }
        modalBody += "</p>";



         
        console.log(modalBody);

        $('#infoModal').html(modalBody);
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log("AJAX request failed: " + textStatus + " " + errorThrown);
        $('#loading-overlay').hide();
      }
    });
    
  });
});
</script>

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

