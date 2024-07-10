@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>Nuevo registro de bitácora</h2>
       
       
       @if($item->idBitacora==0)
        <form method="post" action="{{route('creaCont.bit')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upCont.bit')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idBitacora>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idBitacora" value="{{$item->idBitacora}}"></div>
            @endif

             <div class="mb-3 d-none"><input type="text" class="form-control" name="idrelPlantaContenedor" value="{{$item->idrelPlantaContenedor}}"></div>

           


             <div class="row">
                <div class="col-12">
                    <label for="cTitulo" class="form-label">Titulo*</label>
                    <input type="text" class="form-control" name="titulo" value="@if($item->idBitacora>0) {{$item->cTitulo}} @endif" required>
                </div>

                 <div class="col-12">
                    <label for="cNota" class="form-label">Describa el registro</label>
                    <textarea class="form-control" name="nota" rows="6">@if($item->idBitacora>0) {{$item->cNota}} @endif</textarea>
                </div>
              
            </div>

            
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary mt-3">
        
            @if($item->idBitacora > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection