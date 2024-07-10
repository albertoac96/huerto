@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>CONTENDOR</h2>
       
       
        <form method="post" action="{{route('creaCont.plantas')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
       
         @csrf

           
               <div class="mb-3 d-none"><input type="text" class="form-control" name="idContenedor" value="{{$info->idContenedor}}"></div>

               @if($registro === 0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idRel" value="0"></div>
              
                @else
   <div class="mb-3 d-none"><input type="text" class="form-control" name="idRel" value="{{$registro->idRel}}"></div>
                @endif

             <div class="mb-3">
    <label for="formFile" class="form-label">Seleccione una planta</label>
    <select class="form-select mb-2" required name="planta">    
        <option value="0">Seleccione la planta</option>   
        @foreach($plantas as $item)
            <option value="{{$item->idPlanta}}" {{ (isset($registro->idPlanta) && $registro->idPlanta == $item->idPlanta) ? 'selected' : '' }}>{{$item->cNombre}}</option>    
        @endforeach
    </select>
</div>

 <div class="mb-3">
    <label for="formFile" class="form-label">Selecciona un experimento</label>
    <select class="form-select mb-2" required name="exp">    
        <option value="0">Seleccione un experimento</option>   
        @foreach($exps as $item)
            <option value="{{$item->idExperimento}}" {{ (isset($registro->idExperimento) && $registro->idExperimento == $item->idExperimento) ? 'selected' : '' }}>{{$item->cExperimento}}</option>    
        @endforeach
    </select>
</div>

  <div class="mb-3 col-12">
                        <label for="cNota" class="form-label">Nota</label>
                        <textarea class="form-control" name="cNota" rows="4">@if(isset($registro->cNota)){{$registro->cNota}}@endif</textarea>
                      
                    </div>




          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
          
                Registrar
 
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection