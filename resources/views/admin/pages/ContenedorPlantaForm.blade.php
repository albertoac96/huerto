@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>CONTENDOR</h2>
       
       
        <form method="post" action="{{route('creaCont.plantas')}}" id="f1" enctype="multipart/form-data">
       
         @csrf

           
               <div class="mb-3 d-none"><input type="text" class="form-control" name="idContenedor" value="{{$info->idContenedor}}"></div>

             <div class="mb-3">
                <label for="formFile" class="form-label">Elige la planta</label>
                <select class="form-select mb-2" required name="planta">    
                    <option value="0" selected>Seleccione la planta</option>   
                    @foreach($plantas as $item)  
                    <option value="{{$item->idPlanta}}">{{$item->cNombre}}</option>    
                   @endforeach
                </select>
            </div>
               
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
          
                Registrar
 
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection