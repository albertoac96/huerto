@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>PLANTA</h2>
       
        @if($item->idPlanta==0)
        <form method="post" action="{{route('creaPlanta')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upPlanta')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idPlanta>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idPlanta" value="{{$item->idPlanta}}"></div>
            @endif

            <div class="row">
                <div class="mb-3 col-4">
                    <label for="cActvidad" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idPlanta>0) {{$item->cNombre}} @endif" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Nombre en Latín</label>
                    <input type="text" class="form-control" name="latin" value="@if($item->idPlanta>0) {{$item->cNombreLatin}} @endif">
                </div>
                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Especie</label>
                    <input type="text" class="form-control" name="especie" value="@if($item->idPlanta>0) {{$item->cEspecie}} @endif">
                </div>

                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Descripción</label>
                    <textarea class="form-control" name="desc" rows="4">@if($item->idPlanta>0) {{$item->cDescripcion}} @endif</textarea>
                </div>
                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Origen</label>
                    <textarea class="form-control" name="origen" rows="4">@if($item->idPlanta>0) {{$item->cOrigen}} @endif</textarea>
                </div>
                <div class="mb-3 col-4">
                    <label for="cDesc" class="form-label">Aportación</label>
                    <textarea class="form-control" name="aportacion" rows="4">@if($item->idPlanta>0) {{$item->cAportacion}} @endif</textarea>
                </div>

                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Beneficios</label>
                    <textarea class="form-control" name="beneficios" rows="4">@if($item->idPlanta>0) {{$item->cBeneficio}} @endif</textarea>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Mantenimiento</label>
                    <textarea class="form-control" name="mantenimiento" rows="4">@if($item->idPlanta>0) {{$item->cMantenimiento}} @endif</textarea>
                </div>


                <div class="mb-3 col-4">
                    <label for="grupo" class="form-label">Grupo</label>
                    <input type="text" class="form-control" name="grupo" value="@if($item->idPlanta>0) {{$item->cNombre}} @endif" required>
                </div>
                <div class="mb-3 col-4">
                    <label for="cicloDeVida" class="form-label">Ciclo de vida</label>
                    <input type="text" class="form-control" name="cicloDeVida" value="@if($item->idPlanta>0) {{$item->cicloDeVida}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="crecimiento" class="form-label">Crecimiento</label>
                    <input type="text" class="form-control" name="crecimiento" value="@if($item->idPlanta>0) {{$item->crecimiento}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="familia" class="form-label">Familia</label>
                    <input type="text" class="form-control" name="familia" value="@if($item->idPlanta>0) {{$item->familia}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="zSiembra" class="form-label">Profundidad de siembra</label>
                    <input type="text" class="form-control" name="zSiembra" value="@if($item->idPlanta>0) {{$item->zSiembra}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="profRaiz" class="form-label">Profundidad de la raíz</label>
                    <input type="text" class="form-control" name="profRaiz" value="@if($item->idPlanta>0) {{$item->profRaiz}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="tipoSuelo" class="form-label">Tipo de suelo</label>
                    <input type="text" class="form-control" name="tipoSuelo" value="@if($item->idPlanta>0) {{$item->tipoSuelo}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="humSuelo" class="form-label">Humedad del suelo</label>
                    <input type="text" class="form-control" name="humSuelo" value="@if($item->idPlanta>0) {{$item->humSuelo}} @endif" >
                </div>

                <div class="mb-3 col-4">
                    <label for="phSuelo" class="form-label">pH del suelo</label>
                    <select class="form-select" name="phSuelo" required>
                        <option value="Ácido (pH menor que 7)">Ácido (pH menor que 7)</option>
                        <option value="Ligeramente ácido (pH entre 6.1 y 6.5)">Ligeramente ácido (pH entre 6.1 y 6.5)</option>
                        <option value="Neutral (pH entre 6.6 y 7.3)">Neutral (pH entre 6.6 y 7.3)</option>
                        <option value="Ligeramente alcalino (pH entre 7.4 y 7.8)">Ligeramente alcalino (pH entre 7.4 y 7.8)</option>
                        <option value="Alcalino (pH mayor que 7)">Alcalino (pH mayor que 7)</option>
                    </select>
                </div>


                <div class="mb-3 col-4">
                    <label for="tgerminacion" class="form-label">Tiempo de germinación</label>
                    <input type="text" class="form-control" name="tgerminacion" value="@if($item->idPlanta>0) {{$item->tgerminacion}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="firstCosecha" class="form-label">Tiempo de germinación a la primera cosecha</label>
                    <input type="text" class="form-control" name="firstCosecha" value="@if($item->idPlanta>0) {{$item->firstCosecha}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="altura" class="form-label">Altura de la cosecha</label>
                    <input type="text" class="form-control" name="altura" value="@if($item->idPlanta>0) {{$item->altura}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="ancho" class="form-label">Ancho de planta</label>
                    <input type="text" class="form-control" name="ancho" value="@if($item->idPlanta>0) {{$item->ancho}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="distPlantas" class="form-label">Esparcimiento entre plantas</label>
                    <input type="text" class="form-control" name="distPlantas" value="@if($item->idPlanta>0) {{$item->distPlantas}} @endif" >
                </div>


                <div class="mb-3 col-4">
                    <label for="tRiego" class="form-label">Cantidad de riego</label>
                    <input type="text" class="form-control" name="tRiego" value="@if($item->idPlanta>0) {{$item->tRiego}} @endif" >
                </div>
                <div class="mb-3 col-4">
                    <label for="cIluminacion" class="form-label">Iluminación del cultivo</label>
                    <input type="text" class="form-control" name="cIluminacion" value="@if($item->idPlanta>0) {{$item->cIluminacion}} @endif" >
                </div>
                 <div class="mb-3 col-4">
                    <label for="tempMin" class="form-label">Temperatura mínima</label>
                    <input type="text" class="form-control" name="tempMin" value="@if($item->idPlanta>0) {{$item->tempMin}} @endif" >
                </div>
                 <div class="mb-3 col-4">
                    <label for="tempMax" class="form-label">Temperatura máxima</label>
                    <input type="text" class="form-control" name="tempMax" value="@if($item->idPlanta>0) {{$item->tempMax}} @endif" >
                </div>

                <div class="col-3 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="comestible" @if($item->idPlanta>0 && $item->iComestible>0) checked @endif>
                        <label class="form-check-label text-start" for="gridCheck1">
                        Comestible
                        </label>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="endemica" @if($item->idPlanta>0 && $item->iEndemica>0) checked @endif>
                        <label class="form-check-label text-start" for="gridCheck1">
                        Endemica
                        </label>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="medicinal"@if($item->idPlanta>0 && $item->iMedicinal>0) checked @endif>
                        <label class="form-check-label text-start" for="gridCheck1">
                        Medicinal
                        </label>
                    </div>
                </div>
                <div class="col-3 mb-3">
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox"  name="perene" @if($item->idPlanta>0 && $item->iPerenne>0) checked @endif>
                        <label class="form-check-label text-start" for="gridCheck1">
                        Perenne
                        </label>
                    </div>
                </div>

            </div>

             <div class="row">
            <div class="mb-3 col-4">
         
                    @if($item->idPlanta>0)
                        <img src="{{asset('images/content/catalogo').'/'.$item->idPlanta.'.webp'}}" class="d-block w-100" alt="...">
                    @else
                         <img src="{{asset('images/si.png')}}" class="d-block w-100" alt="...">
                    @endif
             
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                @if($item->idPlanta==0)
                     <input class="form-control" type="file" name="archivo" required>
                @else
                     <input class="form-control" type="file" name="archivo">
                @endif
               
            </div>
            </div>
         
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idPlanta > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection