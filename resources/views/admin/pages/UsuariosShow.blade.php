@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>USUARIOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newUser(0)">Nuevo usuario</button>
    </div>
    <table class="table table-sm" id="tableUsers" style="heigth: 70%; margin: auto;">
        <thead class="table-success">
            <tr>
               <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Edad</th>
                <th>Comunidad Ibero</th>
                <th>Semestre</th>
                <th>Tipo</th>
                <th>Estatus</th>
                <th>Registrado el</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                     <tr class="text-center">
                    <td>{{$item->idUsuario}}
                    <img src="{{asset('images/content/colaboradores')."/".$item->idUsuario.'.webp'}}" class="img-fluid" width="50px" height="50px">
                    </td>
                    <td class="fs-6 fw-lighter text-start">{{$item->nombre}} {{$item->apellido}}</td>
                   
                    <td class="fs-6 fw-lighter text-start">{{$item->email}}</td>
                    <td class="fs-6 fw-lighter text-start">{{$item->telefono}}</td>
                    <td class="fs-6 fw-lighter text-start">{{$item->edad}}</td>
                    <td class="fs-6 fw-lighter text-start">{{$item->comunidadIbero}}</td>
                    <td class="fs-6 fw-lighter text-start">{{$item->cSemestre}}</td>
                    <td class="fs-6 fw-lighter text-start">
                        @if($item->tipo==1)
                            Administrador
                        @else
                            Editor
                        @endif
                    </td>
                    <td class="fs-6 fw-lighter text-start">
                        @if($item->cEstatus=='A')
                            Activo
                        @else
                            Inactivo
                        @endif
                    </td>
                    <td class="fs-6 fw-lighter">{{$FechaCorta($item->created_at)}}</td>
                    <td class="fs-6 fw-lighter">
                        <button type="button" class="btn btn-warning m-2" onclick="upUser({{$item->idUsuario}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                       
                            <button type="button" class="btn btn-danger" onclick="deletUser({{$item->idUsuario}})">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                       
                    </button></td>
                    </tr>
            @endforeach
        </tbody>
    </table>


  



 

</div>
@endsection

@section('js')

<script>
$(document).ready(function() {
    $('#tableUsers').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function deletUser(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delUser", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        // Redirigir para eliminar el usuario
        window.location = userUrl;
    }

    function upUser(userId){
        var baseUrl = '{{ route("formUser", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newUser(userId){
        var baseUrl = '{{ route("formUser", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection


