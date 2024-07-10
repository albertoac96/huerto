@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>ACTIVIDADES</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newAct(0)">Nueva actividad</button>
    </div>
    <table class="table table-sm" id="tableActividades">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col" class="d-none d-sm-block">Descripcion</th>
                <th scope="col">Lugar</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $item)
                    <tr class="text-center">
                    <th>{{$item->idActividad}}</th>
                    <th>{{$item->cActividad}}</th>
                    <th class="fs-6 fw-lighter text-start">{{$item->cDescripcion}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cLugar}}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaCorta($item->dActividad) }}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upAct({{$item->idActividad}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="deleteAct({{$item->idActividad}})">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


@section('js')

<script>
$(document).ready(function() {
    $('#tableActividades').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});



function deleteAct(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delActividad", ["id" => "_id_"]) }}';
   
        
        var userUrl = baseUrl.replace('_id_', userId);

         if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upAct(userId){
        var baseUrl = '{{ route("formActividad", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newAct(userId){
        var baseUrl = '{{ route("formActividad", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection

