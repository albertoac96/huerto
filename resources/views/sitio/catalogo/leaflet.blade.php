 <div class="secClara">
     <h2>
         <label class="titulo">INFOGRAFÍA INTERACTIVA DE LOS CULTIVOS</label>
     </h2>
     <p>
         A través de nuestro mapa interactivo, conocerás las camas de cultivo<br>
         ¡Conócelas dando click en cada uno de los iconos!
     </p>

     <div class="container">

         <div id="mapa" style="width: 100%; height: 600px;"></div>
     </div>
 </div>



 <!-- Modal -->
 <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-height:300px">
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



 @section('estilos')
 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
 <style>
     #mapa {
         height: 600px;
         background-color: #7FAE83;
         /* Cambia esto por el color que prefieras */
     }

     .custom-tooltip {
         background-color: black;
         color: white;
         border: 2px solid #019618;
         padding: 5px;
         border-radius: 4px;
         font-family: Arial, sans-serif;
         font-size: 16px;
         /* Ajusta el tamaño de la fuente según necesites */
     }

     @keyframes pulse {
         0% {
             transform: scale(1);
             opacity: 1;
         }

         50% {
             transform: scale(1.0005);
             opacity: 0.6;
         }

         100% {
             transform: scale(1);
             opacity: 1;
         }
     }

     .pulsing-icon {
         animation: pulse 2s infinite;
     }



     .pagination {
         display: inline-block;
         padding-left: 0;
         margin: 20px 0;
         border-radius: 4px;
     }

     .pagination a {
         color: #007bff;
         /* Cambia el color aquí */
         float: left;
         padding: 8px 16px;
         text-decoration: none;
         transition: background-color .3s;
         border: 1px solid #ddd;
         /* Agrega borde si es necesario */
     }

     .pagination a.active {
         background-color: #007bff;
         color: white;
         border: 1px solid #007bff;
     }

     .pagination a:hover:not(.active) {
         background-color: #ddd;
     }

 </style>
 @endsection

 @section('js')
 <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         var map = L.map('mapa', {
             crs: L.CRS.Simple
             , minZoom: -1
             , maxZoom: 3
             , maxBoundsViscosity: 1.0
         });

         // Assuming the dimensions of the SVG are known, for example 1024x768
         var bounds = [
             [0, 0]
             , [1000, 1200]
         ];

         // Provide the URL to your SVG image
         var image = L.imageOverlay('images/huerto_plantilla.svg', bounds).addTo(map);

         map.fitBounds(bounds);

         var itemsMapa = @json($mapa);
         console.log(itemsMapa);

         for (var i = 0; itemsMapa.length > i; i++) {
             console.log("entre a mapa puntos");
             if (itemsMapa[i].cUbicacion != null) {
                 agregarPunto(itemsMapa[i]);
             }

         }






         function agregarPunto(item) {
             var parts = item.cUbicacion.split(','); // Suponiendo que la ubicación es una cadena "lat,lng"
             var lat = parseFloat(parts[0]);
             var lng = parseFloat(parts[1]);
             var latLng = L.latLng(lat, lng); // Crea el objeto LatLng

             // Crea un nuevo círculo en el lugar especificado
             var circle = L.circle(latLng, {
                 color: 'white'
                 , fillColor: '#019618'
                 , fillOpacity: 0.8
                 , radius: 16
                 , className: 'pulsing-icon'
             }).addTo(map);

             // Vincula un tooltip al círculo
             circle.bindTooltip(item.cNombre, {
                 permanent: true, // Tooltip siempre visible
                 direction: 'bottom', // El tooltip intenta colocarse de manera inteligente
                 className: 'custom-tooltip' // Clase CSS para estilizar el tooltip si es necesario
             });

             // Agrega un evento de clic al círculo
             circle.on('click', function(e) {
                 console.log(item); // Imprime el evento a la consola

                 $('#loading-overlay').show();
                 var modalBody = "";
                 $('#infoModal').html(modalBody);
                 var value = item.idContenedor;
                 if (value === undefined) {
                     return;
                 }
                 console.log(value);
                 let title = item.cNombre;
                 $('#tituloCama').text(title);
                 $.ajax({
                     url: "catalogo/infoCama/" + value
                     , method: "GET"
                     , success: function(response) {
                         $('#modal').modal('show');
                         console.log(response);
                         $('#loading-overlay').hide();

                         modalBody = '<p><b>Experimento:</b> ';
                         if (response.exps.length == 0 || response.exps[0].idExperimento == null) {
                             modalBody += 'Sin experimento';
                         } else {
                             response.exps.forEach(function(exp) {
                                 modalBody += `${exp.cExperimento}`;
                             });
                         }
                         modalBody += "</p>";

                         modalBody += '<p><b>Encargado:</b> ';
                         if (response.user.length == 0 || response.user[0].nombre == null) {
                             modalBody += 'Sin encargado';
                         } else {
                             response.user.forEach(function(us) {
                                 modalBody += `<a href="${us.cLink}" target="_blank" style="color:black;">${us.nombre} `;
                                 modalBody += `${us.apellido} </a>`;
                             });
                         }
                         modalBody += "</p>";

                         modalBody += '<p><b>Plantas asociadas:</b> ';
                         if (response.plantas.length == 0 || response.plantas[0].idPlanta == null) {
                             modalBody += 'Sin plantas';
                         } else {
                             modalBody += '<div class="row row-cols-3">';
                             response.plantas.forEach(function(planta) {
                                 modalBody += '<div class="col"><div class="img-circle mt-2">';
                                 modalBody += `<img src="../images/content/catalogo/${planta.idPlanta}.webp" class="img-fluid rounded-circle" alt="..."></div>`
                                 modalBody += `<center><a class="textcard2" href="planta/${planta.idPlanta}">${planta.cNombre}</a></center></div>`
                             });
                             modalBody += "</div>";
                         }
                         modalBody += "</p>";




                         console.log(modalBody);

                         $('#infoModal').html(modalBody);
                     }
                     , error: function(xhr, textStatus, errorThrown) {
                         console.log("AJAX request failed: " + textStatus + " " + errorThrown);
                         $('#loading-overlay').hide();
                     }
                 });

                 // Otras acciones como abrir un modal, actualizar información, etc.
                 // Ejemplo: actualizarInformacion(e.latlng);
             });
         }


     })

 </script>

 @endsection
