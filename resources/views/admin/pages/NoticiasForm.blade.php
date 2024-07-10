@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>NOTICIA</h2>
       
        @if($item->idNoticia==0)
        <form method="post" action="{{route('creaNoticia')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upNoticia')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idNoticia>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idNoticia" value="{{$item->idNoticia}}"></div>
            @endif
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre de la noticia</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idNoticia>0) {{$item->cNoticia}} @endif" required>
            </div>

            

          
            <div class="mb-3">
                <label for="cDesc" class="form-label">Descripcion</label>
                <textarea class="form-control" name="desc" rows="3" required>@if($item->idNoticia>0) {{$item->cContenido}} @endif</textarea>
            </div>
          
          
            <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idNoticia>0)
                        <img src="{{asset('images/content/noticias').'/'.$item->idNoticia.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idNoticia==0)
                     <input class="form-control" type="file" name="archivo" required>
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>

            <div class="mb-3">
                <label for="cLink" class="form-label">Link relacionado</label>
                <input type="text" class="form-control" name="link" value="@if($item->idNoticia>0) {{$item->cLink}} @endif">
            </div>

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idNoticia > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection