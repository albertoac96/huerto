@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>EXPERIMENTO</h2>
       
        @if($item->idExperimento==0)
        <form method="post" action="{{route('creaExp')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upExp')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idExperimento>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idExperimento" value="{{$item->idExperimento}}"></div>
            @endif


            
          
           
           
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="@if($item->idExperimento>0) {{$item->cExperimento}} @endif" required>
            </div>

            <div class="mb-3">
                <label for="cActvidad" class="form-label">Número</label>
                <input type="text" class="form-control" name="num" value="@if($item->idExperimento>0) {{$item->nExperimento}} @endif" required>
            </div>

             <div class="mb-3">
                <label for="cDesc" class="form-label">Notas</label>
                <textarea class="form-control" name="notas" rows="3" required>@if($item->idExperimento>0) {{$item->cNotas}} @endif</textarea>
            </div>

             <div class="row">
                 <div class="mb-3 col-6">
                <label for="cDesc" class="form-label">Fecha</label> 
                @if($item->idExperimento>0)
                <input type="date" name="inicio" step="1" value="{{$item->dInicio}}" required>
                @else
                <input type="date" name="inicio" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>
                 <div class="mb-3 col-6">
                <label for="cDesc" class="form-label">Fecha</label> 
                @if($item->idExperimento>0)
                <input type="date" name="fin" step="1" value="{{$item->dInicio}}" required>
                @else
                <input type="date" name="fin" step="1" value="{{$Hoy()}}" required>
                @endif
            </div>
            </div>
            

          
            <div class="mb-3">
                <label for="formFile" class="form-label">Proyecto asociado</label>
                <select class="form-select mb-2" value="@if($item->idExperimento>0) {{$item->idProyecto}} @else 0 @endif" required name="proyecto">    
                    <option value="0" @if($item->idExperimento>0 && $item->idProyecto==0) selected @endif>Seleccione el proyecto</option>    
                  @foreach($proyectos as $proyecto)
                    @if($item->idExperimento>0 && $proyecto->idProyecto==$item->idProyecto)
                        <option value="{{$proyecto->idProyecto}}" selected >{{$proyecto->cNombre}}</option>';
                    @else
                       <option value="{{$proyecto->idProyecto}}">{{$proyecto->cNombre}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>

           
             
         


           

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idExperimento > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection