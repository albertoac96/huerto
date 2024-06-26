@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>EVENTOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formEvento', ['id' => 0]) }}'">Nuevo evento</button>
    </div>
    <table class="table table-sm">
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
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formEvento', ['id' => $item->idEvento]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delEvento', ['id' => $item->idEvento]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


