@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>CONTENDOR</h2>
       
        @if($item->idContenedor==0)
        <form method="post" action="{{route('creaCont')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upCont')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idContenedor>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idContenedor" value="{{$item->idContenedor}}"></div>
            @endif


           
                <div class="mb-3 col-12">
                    <label for="cActvidad" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idContenedor>0) {{$item->cNombre}} @endif" required>
                </div>

              

             <div class="mb-3">
                <label for="formFile" class="form-label">Tipo</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->cTipo}} @endif" required name="tipo">    
                    <option value="0" @if($item->idContenedor==0) selected @endif>Seleccione el tipo de contenedor</option>     
                    <option value="cama" @if($item->idContenedor>0 && $item->cTipo=='cama') selected @endif>Cama</option>    
                    <option value="hidromaceta" @if($item->idContenedor>0 &&$item->cTipo=='hidromaceta') selected @endif>Hidromaceta</option>  
                    <option value="bolsa" @if($item->idContenedor>0 &&$item->cTipo=='bolsa') selected @endif>Bolsa</option>
                    <option value="adaptado" @if($item->idContenedor>0 &&$item->cTipo=='adaptado') selected @endif>Adaptado</option>
                </select>
            </div>
               
           <div class="mb-3">
                <label for="formFile" class="form-label">Encargado</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->idEncargado}} @else 0 @endif" required name="res">    
                    <option value="0" @if($item->idContenedor>0 && $item->idEncargado==0) selected @endif>Seleccione el responsable</option>    
                  @foreach($responsables as $res)
                    @if($item->idContenedor>0 && $res->idUsuario==$item->idEncargado)
                        <option value="{{$res->idUsuario}}" selected >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @else
                        <option value="{{$res->idUsuario}}" >{{$res->apellido}} {{$res->nombre}} - {{$res->comunidadIbero}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Experimento</label>
                <select class="form-select mb-2" value="@if($item->idContenedor>0) {{$item->idExperimento}} @else 0 @endif" required name="exp">    
                    <option value="0" @if($item->idContenedor>0 && $item->idExperimento==0) selected @endif>Seleccione el responsable</option>    
                  @foreach($experimentos as $exp)
                    @if($item->idContenedor>0 && $exp->idExperimento==$item->idExperimento)
                        <option value="{{$exp->idExperimento}}" selected >{{$exp->cExperimento}}</option>';
                    @else
                        <option value="{{$exp->idExperimento}}" >{{$exp->cExperimento}}</option>';
                    @endif
                  @endforeach
                </select>
            </div>

            
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idContenedor > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection