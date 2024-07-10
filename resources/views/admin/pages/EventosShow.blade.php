@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>EVENTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newEvent(0)">Nuevo evento</button>
    </div>
    <table class="table table-sm" id="tableEventos">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Lugar</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idEvento}}</th>
                    <th>{{$item->cEvento}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cLugar}}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaCorta($item->dEvento) }}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upEvent({{$item->idEvento}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delEvent({{$item->idEvento}})">
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
    $('#tableEventos').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function delEvent(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delEvento", ["id" => "_id_"]) }}';
   
        
        var userUrl = baseUrl.replace('_id_', userId);

          if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upEvent(userId){
        var baseUrl = '{{ route("formEvento", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newEvent(userId){
        var baseUrl = '{{ route("formEvento", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection

