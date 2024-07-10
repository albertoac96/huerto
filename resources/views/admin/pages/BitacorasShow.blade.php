@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    @if(!empty($items[0]))
    <h3>Bitacora de la planta <b>{{$items[0]->planta}}</b> asociada a <b>{{$items[0]->contenedor}}</b></h3>
   @else
<h3>Bitacora</h3>
   @endif
    <div class="text-end">
    
        <button type="button" class="btn btn-primary mb-3" onclick="newBit(0)">Nuevo registro</button>
    </div>
    <table class="table table-sm" id="tableBit">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titulo</th>
                <th scope="col">Creada por</th>
                <th scope="col">Creada el</th>
                <th scope="col">Última actualización</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <td>{{$item->idBitacora}}</td>
                    <td>{{$item->cTitulo}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$FechaCorta($item->created_at)}}</td>
                  <td>{{$FechaCorta($item->updated_at)}}</td>
                    <td class="fs-6 fw-lighter">

                      <button id="btnVer" type="button" class="btn btn-outline-info" onclick="verBit({{$item}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa fa-info-circle" aria-hidden="true"></i></button>

<button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upBit({{$item->idBitacora}}, {{$item->idrelPlantaContenedor}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>

                        
                    @if($item->cEstatus === "A")
                        <button id="btnBaja" type="button" class="btn btn-danger" 
                        onclick="btnEstatus({{$item->idBitacora}}, 'B')">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    @else
                        <button id="btnBaja" type="button" class="btn btn-light" 
                        onclick="btnEstatus({{$item->idBitacora}}, 'A')">
                        <i class="fa fa-toggle-off" aria-hidden="true"></i></button>
                    @endif
                    
                        


                      
                       
                    </td>
                    </tr>
            @endforeach
        </tbody>
    </table>


<!-- Modal -->
<div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Modal title</h5>
      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align: left;">
       <label><b>Creador por: </b></label>
        <label id="cCreador"></label><br>
        <label><b>Fecha de creación: </b></label>
        <label id="created_at"></label><br>
        <label><b>Última actualización</b></label>
        <label id="updated_at"></label><br><br>
        <label><b>Descripción: </b></label>
         <p id="registroModal"></p>

         <label><b>Imagenes asociadas: </b></label>
         <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadImageModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
         <div class="container" id="imagesContainer">
            <!-- Las imágenes se añadirán dinámicamente aquí -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>

      </div>
    </div>
  </div>
</div>



<!-- Modal AGREGAR IMAGEN-->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadImageModalLabel">Subir Nueva Imagen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="imageUploadForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- Token CSRF -->
          <div class="mb-3">
            <label for="imageInput" class="form-label">Seleccione imagen</label>
            <input type="file" class="form-control" id="imageInput" name="image">
          </div>
          <button type="submit" class="btn btn-primary" onclick="addImagen()" >Subir Imagen</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para la imagen en tamaño grande -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="largeImage" class="img-fluid" alt="Imagen ampliada" style="width: 100%; height: auto;">
      </div>
    
    </div>
  </div>
</div>


 

</div>
@endsection



@section('js')

<script>
$(document).ready(function() {
    $('#tableBit').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

var itemSeleccionado = [];




 function addImagen(){
document.getElementById('overlay').style.display = 'flex';

  event.preventDefault();  // Prevenir la recarga de la página

  var formData = new FormData();
  formData.append('image', document.getElementById('imageInput').files[0]);
  formData.append('idBitacora', itemSeleccionado.idBitacora);
  formData.append('_token', '{{ csrf_token() }}'); // Agregar el token CSRF
  
  fetch('/admin/contenedor/bitacora/uploadimg', {  // Cambia esto por la URL de tu servidor que maneja la carga
    method: 'POST',
    body: formData,
  })
  .then(response => {
            if (response.ok) {
               console.log(response);
                $('#imageInput').replaceWith($('#myFileInput').val('').clone(true));
                var modalEl = document.getElementById('uploadImageModal');
                var modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) {
                    console.log("entre a ocultar")
                modalInstance.hide();
                } else {
                console.error('No modal instance found!');
                }
            
                $('#staticBackdrop').modal('show'); // Mostrar el modal uploadImageModal
                console.log(itemSeleccionado);
                verBit(itemSeleccionado);
            }
            throw new Error('Algo salió mal en la API del servidor.');
        })
  .then(data => {
    
  
  })
  .catch((error) => {
   
  });

 
}

function delBit(userId, total) {

   
 
    var baseUrl = '{{ route("delCont.bit", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        // Redirigir para eliminar el usuario
        window.location = userUrl;
    }

     function btnEstatus(idPlanta, cEstatus) {
   


    var baseUrl = '{{ route("estCont.bit", ["id" => "_id_", "estatus" => "_estatus_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', idPlanta);
        userUrl = userUrl.replace('_estatus_', cEstatus);

        // Redirigir para eliminar el usuario
        window.location = userUrl;
    }


  

    function upBit(userId, idRel){
        var baseUrl = '{{ route("formCont.bit", ["id" => "_id_", "idRel" => "_idRel_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);
        userUrl = userUrl.replace('_idRel_', userId);

        window.location = userUrl;
    }

     function newBit(userId){

       let rutaActual = window.location.pathname;
let segmentos = rutaActual.split('/');  // Divide la ruta en segmentos
let ultimoParametro = segmentos[segmentos.length - 1];  // Obtiene el último segmento


        var baseUrl = '{{ route("formCont.bit", ["id" => "_id_", "idRel" => "_idRel_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);
         userUrl = userUrl.replace('_idRel_', ultimoParametro);

       

        window.location = userUrl;
    }

    function showImageInModal(imageUrl) {
    $('#largeImage').attr('src', imageUrl);  // Establece el src del img en el modal
    $('#imageModal').modal('show');  // Muestra el modal
}

function deleteImage(idBitImg, event) {
  
    document.getElementById('overlay').style.display = 'flex';
     $.ajax({
            url: '/admin/contenedor/bitacora/delimg/' + idBitImg, // Asegúrate de que la URL coincide con la ruta definida en Laravel
            type: 'GET',
            success: function(data) {
               console.log(data);
               verBit(itemSeleccionado);
            },
            error: function() {
                alert('No se pudieron cargar las imágenes');
            }
         });
    // Tu código para eliminar la imagen
}

    function verBit(item){
        itemSeleccionado = item;
         document.getElementById('overlay').style.display = 'flex';
        console.log(item.idBitacora);
        document.getElementById('tituloModal').textContent = item.cTitulo;
        document.getElementById('cCreador').textContent = item.name;
        document.getElementById('created_at').textContent = fechaCorta(item.created_at);
        document.getElementById('updated_at').textContent = fechaCorta(item.updated_at);
        document.getElementById('registroModal').textContent = item.cNota;

         $.ajax({
            url: '/admin/contenedor/bitacora/imgs/' + item.idBitacora, // Asegúrate de que la URL coincide con la ruta definida en Laravel
            type: 'GET',
            success: function(data) {
                console.log(data);
                if(data.length === 0){
                     $('#imagesContainer').html("No hay imagenes asociadas");
                } else {
                    var baseUrl = "{{ asset('images/content/bitacora') }}";
                    let content = '';
                    data.forEach((image, index) => {
                        if (index % 3 === 0) { // Nueva fila cada 3 imágenes
                            content += '<div class="row">';
                        }
                        content += `
                            <div class="col-md-4">
                                <div class="image-wrapper">
                                    <img src="${baseUrl}/${image.idBitacora}-${image.idBitImg}.webp" class="img-fluid" 
                                    onclick="showImageInModal('${baseUrl}/${image.idBitacora}-${image.idBitImg}.webp')"
                                    >
                                    <i class="fa fa-times image-delete-icon" onclick="deleteImage(${image.idBitImg})"></i>
                                </div>
                            </div>
                        `;
                        if ((index + 1) % 3 === 0) {
                            content += '</div>'; // Cerrar fila después de tres imágenes
                        }
                    });
                    if (data.length % 3 !== 0) {
                        content += '</div>'; // Cerrar la última fila si no tiene tres imágenes
                    }
                       $('#imagesContainer').html(content);
                }
             
                 document.getElementById('overlay').style.display = 'none';
            },
            error: function() {
                alert('No se pudieron cargar las imágenes');
            }
         });
    }

  
</script>

@endsection

@section('estilos')
<style>
.image-wrapper {
    position: relative;
    display: inline-block;
    margin: 10px;
}

.image-delete-icon {
    position: absolute;
    top: 0;
    right: 0;
    cursor: pointer;
    color: red; /* Color del ícono para que resalte */
}
</style>

@endsection