@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>EXPERIMENTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formExp', ['id' => 0]) }}'">Nuevo Experimento</button>
    </div>
    <table class="table table-sm">
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
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formExp', ['id' => $item->idExperimento]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delExp', ['id' => $item->idExperimento]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


