@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>CONTENEDORES</h2>
   
    <div class="text-end">
     <button type="button" class="btn btn-outline-success mb-3" onclick="location.href='{{ route('contenedores.tipos') }}'">Administrar tipos</button>
        <button type="button" class="btn btn-primary mb-3" onclick="newConte(0)">Nuevo Contenedor</button>
    </div>
    <table class="table table-sm" id="tableContenedor">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Experimento</th>
                <th scope="col">Encargado</th>
                <th scope="col">Nota</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idContenedor}}</th>
                    <th>{{$item->cNombre}}</th>
                    <th class="fs-6 fw-lighter">{{$item->tipo}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cExperimento}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nombre}} {{$item->apellido}}</th>
                     <th class="fs-6 fw-lighter">{{$item->cNota}}</th>
                    <th class="fs-6 fw-lighter">
                     <button type="button" class="btn btn-success" onclick="verPlantas({{$item->idContenedor}})">
                        <i class="fa fa-leaf" aria-hidden="true"></i></button>
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upConte({{$item->idContenedor}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="deleteConte({{$item->idContenedor}})">
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
    $('#tableContenedor').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function deleteConte(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delCont", ["id" => "_id_"]) }}';
   
      
        var userUrl = baseUrl.replace('_id_', userId);

           if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

  

    function upConte(userId){
        var baseUrl = '{{ route("formCont", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newConte(userId){
        var baseUrl = '{{ route("formCont", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

    function verPlantas(idConte){
        var baseUrl = '{{ route("contenedores.plantas", ["id" => "_id_"]) }}';
          document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', idConte);

        window.location = userUrl;
    }
</script>

@endsection
