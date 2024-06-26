@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>CAPACITACIÓN</h2>
       
        @if($item->idCapacitacion==0)
        <form method="post" action="{{route('creaCapacitacion')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upCapacitacion')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idCapacitacion>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idCapacitacion" value="{{$item->idCapacitacion}}"></div>
            @endif
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre de la actividad</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idCapacitacion>0) {{$item->cCapacitacion}} @endif" required>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Tipo</label>
                <select class="form-select mb-2" value="@if($item->idCapacitacion>0) {{$item->cTipo}} @endif" required name="tipo">    
                    <option value="0" @if($item->idCapacitacion==0) selected @endif>Seleccione el tipo de capacitación</option>     
                    <option value="taller" @if($item->cTipo=='taller') selected @endif>Taller</option>    
                    <option value="curso" @if($item->cTipo=='curso') selected @endif>Curso</option>  
                    <option value="tutorial" @if($item->cTipo=='tutorial') selected @endif>Tutorial</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="cLugar" class="form-label">Lugar de la actividad</label>
                <input type="text" class="form-control" name="lugar" value="@if($item->idCapacitacion>0) {{$item->cLugar}} @endif"] required>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Descripción</label>
                <textarea class="form-control" name="desc" rows="3" required>@if($item->idCapacitacion>0) {{$item->cDescripcion}} @endif</textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">iFrame Multimedia</label>
                <textarea class="form-control" name="multimedia" rows="3">@if($item->idCapacitacion>0) {{$item->cMultimedia}} @endif</textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Fecha</label> 
                @if($item->idCapacitacion>0)
                <input type="date" name="fecha" step="1" value="{{$item->dCapacitacion}}" required>
                @else
                <input type="date" name="fecha" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>
            <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idCapacitacion>0)
                        <img src="{{asset('images/content/capacitaciones').'/'.$item->idCapacitacion.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idCapacitacion==0)
                     <input class="form-control" type="file" name="archivo">
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>

            <div class="mb-3">
                <label for="cLink" class="form-label">Link relacionado</label>
                <input type="text" class="form-control" name="link" value="@if($item->idCapacitacion>0) {{$item->cLink}} @endif">
            </div>

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idCapacitacion > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection