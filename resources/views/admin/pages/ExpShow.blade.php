@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>EXPERIMENTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newExp(0)">Nuevo Experimento</button>
    </div>
    <table class="table table-sm" id="tableExps">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Número</th>
                <th scope="col">Proyecto</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de fin</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idExperimento}}</th>
                    <th>{{$item->cExperimento}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nExperimento}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cNombre}}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaEsp($item->dInicio) }}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaEsp($item->dFin) }}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upExp({{$item->idExperimento}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delExp({{$item->idExperimento}})">
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
    $('#tableExps').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function delExp(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delExp", ["id" => "_id_"]) }}';
   
        
        var userUrl = baseUrl.replace('_id_', userId);

      if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upExp(userId){
        var baseUrl = '{{ route("formExp", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newExp(userId){
        var baseUrl = '{{ route("formExp", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection

