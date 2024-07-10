@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>PLANTAS ASOCIADAS A {{$info->cNombre}}</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newCont({{$info->idContenedor}}, 0)">Nueva Planta</button>
    </div>
    <table class="table table-sm" id="tableCont">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Planta</th>
                 <th scope="col">Fecha de asociación</th>
                 <th scope="col">Usuario</th>
                 <th scope="col">Experimento</th>
                 <th scope="col">Nota</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plantas as $item)
                    <tr class="text-center">
                    <td>{{$item->idRel}}</td>
                    <td><a href="{{route('verPlanta', ['id' => $item->idPlanta])}}" target="_blank" style="color: black;">{{$item->cNombre}}</a></td>
                    <td>{{$FechaCorta($item->fecha)}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->cExperimento}}</td>
                    <td>{{$item->cNota}}</td>
                    <td class="fs-6 fw-lighter">
                    @if($item->estatus === "A")
                        <button id="btnBaja" type="button" class="btn btn-success" 
                        onclick="btnEstatus({{$item->idPlanta}}, {{$info->idContenedor}}, 'B')">
                        <i class="fa fa-toggle-on" aria-hidden="true"></i></button>
                    @else
                        <button id="btnBaja" type="button" class="btn btn-light" 
                        onclick="btnEstatus({{$item->idPlanta}}, {{$info->idContenedor}}, 'A')">
                        <i class="fa fa-toggle-off" aria-hidden="true"></i></button>
                    @endif
                     <button id="btnBitacora" type="button" class="btn btn-warning" 
                        onclick="verBitacora({{$item->idRel}})">
                        <i class="fa fa-sticky-note" aria-hidden="true"></i></button>
                         <button id="btnUpdate" type="button" class="btn btn-info" 
                        onclick="newCont({{$info->idContenedor}}, {{$item->idRel}})">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" 
                        onclick="deleteCont({{$item->idPlanta}}, {{$info->idContenedor}})">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                       
                    </td>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection



@section('js')

<script>




$(document).ready(function() {
    $('#tableCont').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function deleteCont(idPlanta, idConte) {
   


    var baseUrl = '{{ route("delCont.plantas", ["id" => "_id_", "conte" => "_conte_"]) }}';
   
       
        var userUrl = baseUrl.replace('_id_', idPlanta);
        userUrl = userUrl.replace('_conte_', idConte);

        if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
        // Redirigir para eliminar el usuario
          document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
    }

       
    }

  function btnEstatus(idPlanta, idConte, cEstatus) {
   


    var baseUrl = '{{ route("bajaCont.plantas", ["id" => "_id_", "conte" => "_conte_", "estatus" => "_estatus_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', idPlanta);
        userUrl = userUrl.replace('_conte_', idConte);
        userUrl = userUrl.replace('_estatus_', cEstatus);

        // Redirigir para eliminar el usuario
        window.location = userUrl;
    }

     function newCont(userId, idRel){

        
        var baseUrl = '{{ route("formCont.plantas", ["id" => "_id_", "idRel" => "_idRel_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);
         userUrl = userUrl.replace('_idRel_', idRel);

        window.location = userUrl;
    }

    function verBitacora(idRel){
    var baseUrl = '{{ route("contenedores.bit", ["idPlanta" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', idRel);

        window.location = userUrl;
    }
</script>

@endsection
