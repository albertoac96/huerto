@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>TIPOS DE CONTENEDORES</h2>
   
    <div class="text-end">
    
        <button type="button" class="btn btn-primary mb-3" onclick="newTipo(0)">Nuevo tipo</button>
    </div>
    <table class="table table-sm" id="tableTipo">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Total registrados</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <td>{{$item->idTipo}}</td>
                    <td>{{$item->cNombre}}</td>
                    <td>{{$item->contenedores_count}}</td>
                  
                    <td class="fs-6 fw-lighter">
                    
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upTipo({{$item->idTipo}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="deleteTipo({{$item->idTipo}}, {{$item->contenedores_count}})">
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
    $('#tableTipo').DataTable({
        responsive: true,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function deleteTipo(userId, total) {

    if(total>0){
         alert('Hay '+total+' registrados con este tipo, por lo que no se puede eliminar');
         return;
    }
 
    var baseUrl = '{{ route("delCont.tipos", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        // Redirigir para eliminar el usuario
        window.location = userUrl;
    }

  

    function upTipo(userId){
        var baseUrl = '{{ route("formCont.tipos", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newTipo(userId){
        var baseUrl = '{{ route("formCont.tipos", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

  
</script>

@endsection