@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>PROYECTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newProyecto(0)">Nuevo Proyecto</button>
    </div>
    <table class="table table-sm" id="tableProyectos">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Responsable</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de fin</th>
                <th scope="col">Huerto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idProyecto}}</th>
                    <th>{{$item->cNombre}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nombre}} {{$item->apellido}}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaCorta($item->dInicio) }}</th>
                    <th class="fs-6 fw-lighter">@isset($item->dFin) {{$FechaCorta($item->dFin)}} @endisset </th>
                    <th class="fs-6 fw-lighter">{{$item->cHuerto}}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upProyecto({{$item->idProyecto}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delProyecto({{$item->idProyecto}})">
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
    $('#tableProyectos').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function delProyecto(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delProyecto", ["id" => "_id_"]) }}';
   
      
        var userUrl = baseUrl.replace('_id_', userId);

        if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upProyecto(userId){
        var baseUrl = '{{ route("formProyecto", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newProyecto(userId){
        var baseUrl = '{{ route("formProyecto", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection
