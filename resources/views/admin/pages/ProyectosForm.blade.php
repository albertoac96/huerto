@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>PROYECTO</h2>
       
        @if($item->idProyecto==0)
        <form method="post" action="{{route('creaProyecto')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upProyecto')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idProyecto>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idProyecto" value="{{$item->idProyecto}}"></div>
            @endif
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idProyecto>0) {{$item->cNombre}} @endif" required>
            </div>

             <div class="mb-3">
                <label for="cDesc" class="form-label">Descripcion</label>
                <textarea class="form-control" name="desc" rows="2" required>@if($item->idProyecto>0) {{$item->cDescripcion}} @endif</textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Problematica</label>
                <textarea class="form-control" name="problem" rows="2" required>@if($item->idProyecto>0) {{$item->cProblematica}} @endif</textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Incidencia</label>
                <textarea class="form-control" name="inci" rows="2">@if($item->idProyecto>0) {{$item->cIncidencia}} @endif</textarea>
            </div>

          
            <div class="mb-3">
                <label for="formFile" class="form-label">Responsable</label>
                <select class="form-select mb-2" value="@if($item->idProyecto>0) {{$item->idResponsable}} @else 0 @endif" required name="res">    
                    <option value="0" @if($item->idProyecto>0 && $item->idResponsable==0) selected @endif>Seleccione el responsable</option>    
                  @foreach($responsables as $res)
                    @if($item->idProyecto>0 && $res->idUsuario==$item->idResponsable)
                        <option value="{{$res->idUsuario}}" selected >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @else
                        <option value="{{$res->idUsuario}}" >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Huerto</label>
                <select class="form-select mb-2" value="@if($item->idProyecto>0) {{$item->idHuerto}} @else 0 @endif" required name="huerto">    
                    <option value="0" @if($item->idProyecto>0 && $item->idHuerto==0) selected @endif>Seleccione el responsable</option>    
                  @foreach($huertos as $huerto)
                    @if($item->idProyecto>0 && $huerto->idHuerto==$item->idHuerto)
                        <option value="{{$huerto->idHuerto}}" selected >{{$huerto->cHuerto}}</option>';
                    @else
                        <option value="{{$huerto->idHuerto}}" >{{$huerto->cHuerto}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>


           
            <div class="mb-3">
                <label for="cDesc" class="form-label">Fecha</label> 
                @if($item->idProyecto>0)
                <input type="date" name="fecha" step="1" value="{{$item->dInicio}}" required>
                @else
                <input type="date" name="fecha" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>


            
            <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idProyecto>0)
                        <img src="{{asset('images/content/proyectos').'/'.$item->idProyecto.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idProyecto==0)
                     <input class="form-control" type="file" name="archivo" required>
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>

           

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idProyecto > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection