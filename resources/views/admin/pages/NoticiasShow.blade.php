@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>NOTICIAS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formNoticia', ['id' => 0]) }}'">Nueva noticia</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Autor</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                    <tr class="text-center">
                    <th>{{$item->idNoticia}}</th>
                    <th>{{$item->cNoticia}}</th>
                    <th class="fs-6 fw-lighter">{{$item->nombre}} {{$item->apellido}}</th>
                    <th class="fs-6 fw-lighter">{{ $FechaCorta($item->created_at) }}</th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formNoticia', ['id' => $item->idNoticia]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delNoticia', ['id' => $item->idNoticia]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


