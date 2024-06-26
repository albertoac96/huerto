@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>HUERTO</h2>
       
        @if($item->idHuerto==0)
        <form method="post" action="{{route('creaHuerto')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upHuerto')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idHuerto>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idHuerto" value="{{$item->idHuerto}}"></div>
            @endif
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre del huerto</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idHuerto>0) {{$item->cHuerto}} @endif" required>
            </div>

           

           
            <div class="mb-3">
                <label for="cDesc" class="form-label">Descripción</label>
                <textarea class="form-control" name="desc" rows="3" required>@if($item->idHuerto>0) {{$item->cDescripcion}} @endif</textarea>
            </div>

            
            <div class="row">
                <div class="mb-3 col-4">
                    <label for="lat" class="form-label">Latitud</label>
                    <input type="text" class="form-control" name="lat" value="@if($item->idHuerto>0) {{$item->cLat}} @endif" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="long" class="form-label">Longitud</label>
                    <input type="text" class="form-control" name="long" value="@if($item->idHuerto>0) {{$item->cLong}} @endif" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="altura" class="form-label">Altura (asnm)</label>
                    <input type="text" class="form-control" name="altura" value="@if($item->idHuerto>0) {{$item->cAltura}} @endif" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Fecha de creación</label>
                @if($item->idHuerto>0)
                <input type="date" name="fecha" step="1" value="{{$item->dCreacion}}" required>
                @else
                <input type="date" name="fecha" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>


            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idHuerto > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection