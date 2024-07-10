@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>TIPO DE CONTENDOR</h2>
       
       
       @if($item->idTipo==0)
        <form method="post" action="{{route('creaCont.tipos')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upCont.tipos')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idTipo>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idTipo" value="{{$item->idTipo}}"></div>
            @endif


             <div class="row">
                <div class="col-12">
                    <label for="cNombre" class="form-label">Nombre*</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idTipo>0) {{$item->cNombre}} @endif" required>
                </div>
              
            </div>

            
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idTipo > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection