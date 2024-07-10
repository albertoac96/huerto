@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>CONTENDOR</h2>
       
        @if($item->idContenedor==0)
        <form method="post" action="{{route('creaCont')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upCont')}}" id="f1"  onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idContenedor>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idContenedor" value="{{$item->idContenedor}}"></div>
            @endif


           
                <div class="mb-3 col-12">
                    <label for="cActvidad" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idContenedor>0) {{$item->cNombre}} @endif" required>
                </div>

              

          

             <div class="mb-3">
                <label for="formFile" class="form-label">Tipo</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->idTipo}} @else 0 @endif" required name="tipo">    
                    <option value="0" @if($item->idContenedor>0 && $item->idTipo==0) selected @endif>Seleccione el tipo de contenedor</option>    
                  @foreach($tipos as $tipo)
                    @if($item->idContenedor>0 && $tipo->idTipo==$item->idTipo)
                        <option value="{{$tipo->idTipo}}" selected >{{$tipo->cNombre}}</option>';
                    @else
                        <option value="{{$tipo->idTipo}}" >{{$tipo->cNombre}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>
               
           <div class="mb-3">
                <label for="formFile" class="form-label">Usuario responsable del contenedor</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->idEncargado}} @else 0 @endif" required name="res">    
                    <option value="0" @if($item->idContenedor>0 && $item->idEncargado==0) selected @endif>Seleccione el responsable</option>    
                  @foreach($responsables as $res)
                    @if($item->idContenedor>0 && $res->idUsuario==$item->idEncargado)
                        <option value="{{$res->idUsuario}}" selected >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @else
                        <option value="{{$res->idUsuario}}" >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Experimento asociado</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->idExperimento}} @else 0 @endif" required name="exp">    
                    <option value="0" @if($item->idContenedor>0 && $item->idExperimento==0) selected @endif>Seleccione el experimento</option>    
                  @foreach($experimentos as $exp)
                    @if($item->idContenedor>0 && $exp->idExperimento==$item->idExperimento)
                        <option value="{{$exp->idExperimento}}" selected >{{$exp->cExperimento}}</option>';
                    @else
                        <option value="{{$exp->idExperimento}}" >{{$exp->cExperimento}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>

             <div class="mb-3 col-12">
                        <label for="nota" class="form-label">Nota de control interno</label>
                        <textarea class="form-control" name="nota" rows="4">@if($item->idContenedor>0){{$item->cNota}}@endif</textarea>
                    </div>

                     <div class="mb-3 col-12">
                    <label for="cCoord" class="form-label">Seleccione la ubicación del mapa*</label>
                    <input type="text" class="form-control" name="ubicacion" id="ubicacion" value="@if($item->idContenedor>0) {{$item->cUbicacion}} @endif" readonly required>
                </div>

<div class="mb-3 col-12">
                     <div id="mapa" style="width: 100%; height: 600px;"></div>
  </div>
            
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idContenedor > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection




@section('estilos')
 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
 <style>
        #mapa {
            height: 600px;
            background-color: #abcdef; /* Cambia esto por el color que prefieras */
        }

        .custom-tooltip {
    background-color: black;
    color: white;
    border: 2px solid #019618;
    padding: 5px;
    border-radius: 4px;
    font-family: Arial, sans-serif;
    font-size: 16px; /* Ajusta el tamaño de la fuente según necesites */
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


     
    </style>
@endsection

@section('js')
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script>

    
   document.addEventListener('DOMContentLoaded', function() {

   var map = L.map('mapa', {
            crs: L.CRS.Simple,
            minZoom: -1,
            maxZoom: 3,
            maxBoundsViscosity: 1.0,
            
        });

        // Assuming the dimensions of the SVG are known, for example 1024x768
        var bounds = [[0, 0], [1000, 1200]];

        // Provide the URL to your SVG image
        var image = L.imageOverlay('/images/huerto_plantilla.svg', bounds).addTo(map);

        map.fitBounds(bounds);


 var currentMarker = null;  // Esta variable almacenará el marcador actual
    var item = @json($item);
    console.log(item);

        var itemsMapa = @json($mapa);
    console.log(itemsMapa);
    for(var i=0; itemsMapa.length>i; i++){
        console.log("entre a mapa puntos");
        if(itemsMapa[i].cUbicacion != null){
            agregarPunto(itemsMapa[i].cUbicacion, itemsMapa[i].cNombre);
        }
        
    }



    if(item.cUbicacion != null){
     var parts = item.cUbicacion.split(','); // Suponiendo que la ubicación es una cadena "lat,lng"
                var lat = parseFloat(parts[0]);
                var lng = parseFloat(parts[1]);
                var latLng = L.latLng(lat, lng); // Crea el objeto LatLng
                    // Crea un nuevo marcador en el lugar clickeado
                  currentMarker = L.circle(latLng, {
                    color: 'white',
                    fillColor: 'red',
                    fillOpacity: 0.8,
                    radius: 16,
                    className: 'pulsing-icon'
                }).addTo(map);
    }


        map.on('click', function(e) {
    // Si ya existe un marcador, lo elimina
    if (currentMarker) {
        map.removeLayer(currentMarker);
    }

    // Crea un nuevo marcador en el lugar clickeado
    currentMarker = L.circle(e.latlng, {
    color: 'white',
    fillColor: 'red',
    fillOpacity: 0.8,
    radius: 16,
    className: 'pulsing-icon'
}).addTo(map);

$('#ubicacion').val(e.latlng.lat + "," + e.latlng.lng);


});

      

        function agregarPunto(ubicacion, etiqueta){
               var parts = ubicacion.split(','); // Suponiendo que la ubicación es una cadena "lat,lng"
                var lat = parseFloat(parts[0]);
                var lng = parseFloat(parts[1]);
                var latLng = L.latLng(lat, lng); // Crea el objeto LatLng
                    // Crea un nuevo marcador en el lugar clickeado
                  var circle = L.circle(latLng, {
                    color: 'white',
                    fillColor: '#019618',
                    fillOpacity: 0.8,
                    radius: 16,
                    className: 'pulsing-icon'
                }).addTo(map);

                circle.bindTooltip(etiqueta, {
                permanent: true,  // El tooltip no es permanente, aparece al pasar el mouse
                direction: 'auto', // El tooltip intenta colocarse de manera inteligente
                className: 'custom-tooltip' // Clase CSS para estilizar el tooltip si es necesario
    });
        }


          })
    </script>

@endsection