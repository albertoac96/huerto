@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>CONTENEDORES</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formCont', ['id' => 0]) }}'">Nuevo Contenedor</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Experimento</th>
                <th scope="col">Encargado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idContenedor}}</th>
                    <th>{{$item->cNombre}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cTipo}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cExperimento}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nombre}} {{$item->apellido}}</th>
                    <th class="fs-6 fw-lighter">
                     <button type="button" class="btn btn-success" onclick="window.location='{{ route('contenedores.plantas', ['id' => $item->idContenedor]) }}'">
                        <i class="fa fa-leaf" aria-hidden="true"></i></button>
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formCont', ['id' => $item->idContenedor]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delCont', ['id' => $item->idContenedor]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                       
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


