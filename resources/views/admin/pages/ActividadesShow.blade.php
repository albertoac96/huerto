@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>ACTIVIDADES</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formActividad', ['id' => 0]) }}'">Nueva actividad</button>
    </div>
    <table class="table table-sm">
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
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formActividad', ['id' => $item->idActividad]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delActividad', ['id' => $item->idActividad]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


