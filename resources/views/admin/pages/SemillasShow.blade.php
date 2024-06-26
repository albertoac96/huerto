@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>SEMILLAS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formSem', ['id' => 0]) }}'">Nueva Semilla</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Color</th>
                <th scope="col">Peso</th>
                <th scope="col">Cosecha</th>
                <th scope="col">Polinizacion</th>
                <th scope="col">Lote</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idSemilla}}</th>
                    <th>{{$item->cNombre}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cColor}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nPeso}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cCosecha}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cTipoPolinizacion}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nLote}}</th>
                    <th class="fs-6 fw-lighter">{{$item->cProveedor}}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formSem', ['id' => $item->idSemilla]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delSem', ['id' => $item->idSemilla]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


