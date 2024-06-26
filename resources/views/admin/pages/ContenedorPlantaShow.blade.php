@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>PLANTAS ASOCIADAS A {{$info->cNombre}}</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formCont.plantas', ['id' => $info->idContenedor]) }}'">Nueva Planta</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Planta</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plantas as $item)
                    <tr class="text-center">
                    <th>{{$item->idPlanta}}</th>
                    <th><a href="{{route('verPlanta', ['id' => $item->idPlanta])}}" target="_blank" style="color: black;">{{$item->cNombre}}</a></th>
                    <th class="fs-6 fw-lighter">
                        <button id="btnEliminar" type="button" class="btn btn-danger" onclick="window.location='{{ route('delCont.plantas', ['id' => $item->idPlanta, 'conte' => $info->idContenedor]) }}'">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                       
                    </th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


