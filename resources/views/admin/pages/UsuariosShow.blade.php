@extends('admin.main.admin')

@section('content')
 

<div class="secClara">
    <h2>USUARIOS</h2>
   
    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="window.location='{{ route('formUser', ['id' => 0]) }}'">Nuevo usuario</button>
    </div>
    <table class="table table-sm">
        <thead class="table-success">
            <tr>
               <th scope="col">ID</th>
                <th scope="col">Nombre</th>
               
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Edad</th>
                <th scope="col">Comunidad Ibero</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estatus</th>
                <th scope="col">Registrado el</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                     <tr class="text-center">
                    <th>{{$item->idUsuario}}
                    <img src="{{asset('images/content/colaboradores')."/".$item->idUsuario.'.webp'}}" class="img-fluid" width="50px" height="50px">
                    </th>
                    <th class="fs-6 fw-lighter text-start">{{$item->nombre}} {{$item->apellido}}</th>
                   
                    <th class="fs-6 fw-lighter text-start">{{$item->email}}</th>
                    <th class="fs-6 fw-lighter text-start">{{$item->telefono}}</th>
                    <th class="fs-6 fw-lighter text-start">{{$item->edad}}</th>
                    <th class="fs-6 fw-lighter text-start">{{$item->comunidadIbero}}</th>
                    <th class="fs-6 fw-lighter text-start">
                        @if($item->tipo==1)
                            Administrador
                        @else
                            Editor
                        @endif
                    </th>
                    <th class="fs-6 fw-lighter text-start">
                        @if($item->cEstatus=='A')
                            Activo
                        @else
                            Inactivo
                        @endif
                    </th>
                    <th class="fs-6 fw-lighter">{{$FechaCorta($item->created_at)}}</th>
                    <th class="fs-6 fw-lighter">
                        <button type="button" class="btn btn-warning m-2" onclick="window.location='{{ route('formUser', ['id' => $item->idUsuario]) }}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                       
                            <button type="button" class="btn btn-danger" onclick="window.location='{{ route('delUser', ['id' => $item->idUsuario]) }}'">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                       
                    </button></th>
                    </tr>
            @endforeach
        </tbody>
    </table>





 

</div>
@endsection


