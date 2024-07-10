@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>SEMILLAS</h2>
   
    <div class="text-end" >
        <button type="button" class="btn btn-primary mb-3" onclick="newSemilla(0)">Nueva Semilla</button>
    </div>
    <table class="table table-sm" id="tableSemillas">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Peso</th>
                <th>Cosecha</th>
                <th>Polinizacion</th>
                <th>Lote</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <td>{{$item->idSemilla}}</td>
                    <td>{{$item->cNombre}}</td>
                    <td class="fs-6 fw-lighter">{{$item->cColor}}</td>
                    <td class="fs-6 fw-lighter">{{$item->nPeso}}</td>
                    <td class="fs-6 fw-lighter">{{$item->cCosecha}}</td>
                    <td class="fs-6 fw-lighter">{{$item->cTipoPolinizacion}}</td>
                    <td class="fs-6 fw-lighter">{{$item->nLote}}</td>
                    <td class="fs-6 fw-lighter">{{$item->cProveedor}}</td>
                    <td class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upSemilla({{$item->idSemilla}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delSemilla({{$item->idSemilla}})">
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
    $('#tableSemillas').DataTable({
        responsive: true,
       
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Todos"]]
    });
    
});

function delSemilla(userId) {
    console.log(userId);
    var baseUrl = '{{ route("delSem", ["id" => "_id_"]) }}';
   
         
        var userUrl = baseUrl.replace('_id_', userId);

          if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
             document.getElementById('overlay').style.display = 'flex';
        window.location = userUrl;
        }
    }

    function upSemilla(userId){
        var baseUrl = '{{ route("formSem", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

     function newSemilla(userId){
        var baseUrl = '{{ route("formSem", ["id" => "_id_"]) }}';
   
         document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }
</script>

@endsection
