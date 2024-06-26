@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>ACTIVIDADES</h2>
       
        @if($item->idActividad==0)
        <form method="post" action="{{route('creaActividad')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upActividad')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idActividad>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idActividad" value="{{$item->idActividad}}"></div>
            @endif
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre de la actividad</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idActividad>0) {{$item->cActividad}} @endif" required>
            </div>
            <div class="mb-3">
                <label for="cLugar" class="form-label">Lugar de la actividad</label>
                <input type="text" class="form-control" name="lugar" value="@if($item->idActividad>0) {{$item->cLugar}} @endif"] required>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Descripción</label>
                <textarea class="form-control" name="desc" rows="3" required>@if($item->idActividad>0) {{$item->cDescripcion}} @endif</textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Fecha</label> 
                @if($item->idActividad>0)
                <input type="date" name="fecha" step="1" value="{{$item->dActividad}}" required>
                @else
                <input type="date" name="fecha" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>
            <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idActividad>0)
                        <img src="{{asset('images/content/actividades').'/'.$item->idActividad.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idActividad==0)
                     <input class="form-control" type="file" name="archivo" required>
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>

            <div class="mb-3">
                <label for="cLink" class="form-label">Link relacionado</label>
                <input type="text" class="form-control" name="link" value="@if($item->idActividad>0) {{$item->cLink}} @endif" required>
            </div>

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idActividad > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection