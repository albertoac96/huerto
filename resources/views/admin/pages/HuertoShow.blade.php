@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>HUERTO</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formHuerto', ['id' => 0]) }}'">Nuevo huerto</button>
    </div>
    <table class="table table-sm">
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
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formHuerto', ['id' => $item->idHuerto]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delHuerto', ['id' => $item->idHuerto]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


