@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>USUARIOS</h2>

        @if($item->idUsuario==0)
        <form method="post" action="{{route('creaUser')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upUser')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idUsuario>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idUsuario" value="{{$item->idUsuario}}"></div>
            @endif
       
       
            <div class="row">


                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idUsuario>0) {{$item->nombre}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" value="@if($item->idUsuario>0) {{$item->apellido}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Correo</label>
                    <input type="text" class="form-control" name="email" value="@if($item->idUsuario>0) {{$item->email}} @endif" required>
                </div>
               
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="tel" value="@if($item->idUsuario>0) {{$item->telefono}} @endif" >
                </div>


               


                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Fecha de nacimiento</label>
                   
                    @if($item->idUsuario>0)
                    <input type="date" name="fecha" step="1" value="{{$item->dNacimiento}}" required>
                    @else
                    <input type="date" name="fecha" step="1" value="{{$Hoy()}}" required>
                    @endif
                </div>
          
                <div class="mb-3 col-4">
                <label for="formFile" class="form-label">Tipo</label>
                <select class="form-select mb-2" value="@if($item->idUsuario>0) {{$item->tipo}} @endif" required name="tipo">    
                    <option value="0" @if($item->idUsuario==0) selected @endif>Seleccione el tipo</option>      
                    <option value="1" @if($item->idUsuario>0 && $item->tipo=='1') selected @endif>Administrador</option>    
                    <option value="2" @if($item->idUsuario>0 && $item->tipo=='2') selected @endif>Editor</option>   
                </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Titulo Ibero</label>
                    <input type="text" class="form-control" name="esco" value="@if($item->idUsuario>0) {{$item->escolaridad}} @endif" >
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Discapacidad</label>
                    <input type="text" class="form-control" name="dis" value="@if($item->idUsuario>0) {{$item->discapacidad}} @endif" >
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Comunidad Ibero</label>
                    <input type="text" class="form-control" name="comunidad" value="@if($item->idUsuario>0) {{$item->comunidadIbero}} @endif" >
                </div>
                <div class="mb-3 col-6">
                    <label for="cActvidad" class="form-label">Otra institución</label>
                    <input type="text" class="form-control" name="otro" value="@if($item->idUsuario>0) {{$item->otraInstitucion}} @endif">
                </div>
                <div class="col-6 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="estatus" @if($item->idUsuario == 0 || $item->cEstatus=='A') checked @endif>
                        <label class="form-check-label text-start" for="gridCheck1">
                        Activo
                        </label>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="public" @if($item->idUsuario == 0 || $item->iPublic>0) checked @endif>
                        <label class="form-check-label text-start" for="gridCheck2">
                        Público
                        </label>
                    </div>
                </div>

                <div class="mb-3 col-12">
                    <label for="cDesc" class="form-label">Semblanza</label>
                    <textarea class="form-control" name="cv" rows="4">@if($item->idUsuario>0) {{$item->semblanza}} @endif</textarea>
                </div>

                <div class="mb-3 col-12">
                <label for="cLink" class="form-label">Link relacionado</label>
                <input type="text" class="form-control" name="link" value="@if($item->idUsuario>0) {{$item->cLink}} @endif" required>
                </div>
            </div>

        
           
         


            <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idUsuario>0)
                        <img src="{{asset('images/content/colaboradores').'/'.$item->idUsuario.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idUsuario==0)
                     <input class="form-control" type="file" name="archivo" required>
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>

          

            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idUsuario > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection