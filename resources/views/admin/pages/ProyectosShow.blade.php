@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>PROYECTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formProyecto', ['id' => 0]) }}'">Nuevo Proyecto</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Responsable</th>
                <th scope="col">Fecha de inicio</th>
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
                    <th class="fs-6 fw-lighter">{{$item->cHuerto}}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formProyecto', ['id' => $item->idProyecto]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delProyecto', ['id' => $item->idProyecto]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


