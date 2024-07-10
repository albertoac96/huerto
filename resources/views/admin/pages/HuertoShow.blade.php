@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>ADMINISTRAR HUERTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newHuerto(0)">Nuevo huerto</button>
    </div>
    <table class="table table-sm" id="tableHuertos">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Huerto</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">asnm</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idHuerto}}</th>
                    <th>{{$item->cHuerto}}</th>
                    <th class="fs-6 fw-lighter text-start">{{$item->cDescripcion}}</th>
                     <th class="fs-6 fw-lighter">{{ $FechaCorta($item->dCreacion) }}</th>
                    <th class="fs-6 fw-lighter">{{$item->cLat}}</th>
                     <th class="fs-6 fw-lighter">{{$item->cLong}}</th>
                       <th class="fs-6 fw-lighter">{{$item->cAltura}}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upHuerto({{$item->idHuerto}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delHuerto({{$item->idHuerto}})">
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
    $('#tableHuertos').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function delHuerto(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delHuerto", ["id" => "_id_"]) }}';
   
       
        var userUrl = baseUrl.replace('_id_', userId);

          if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upHuerto(userId){
        var baseUrl = '{{ route("formHuerto", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newHuerto(userId){
        var baseUrl = '{{ route("formHuerto", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection
