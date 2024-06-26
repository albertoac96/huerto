@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
        <h2>SEMILLA</h2>
       
        @if($item->idSemilla==0)
        <form method="post" action="{{route('creaSem')}}" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upSem')}}" id="f1" enctype="multipart/form-data">
        @endif
         @csrf

            @if($item->idSemilla>0)
                <div class="mb-3 d-none"><input type="text" class="form-control" name="idSemilla" value="{{$item->idSemilla}}"></div>
            @endif


             <div class="row">
                <div class="mb-3 col-12">
                    <label for="cActvidad" class="form-label">Nombre de la semilla</label>
                    <input type="text" class="form-control" name="nombre" value="@if($item->idSemilla>0) {{$item->cNombre}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" value="@if($item->idSemilla>0) {{$item->cColor}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Peso</label>
                    <input type="text" class="form-control" name="peso" value="@if($item->idSemilla>0) {{$item->nPeso}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Cosecha</label>
                    <input type="text" class="form-control" name="cosecha" value="@if($item->idSemilla>0) {{$item->cCosecha}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Tipo de Polinización</label>
                    <input type="text" class="form-control" name="poli" value="@if($item->idSemilla>0) {{$item->cTipoPolinizacion}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Costo unitario</label>
                    <input type="text" class="form-control" name="costo" value="@if($item->idSemilla>0) {{$item->nCostoUnitario}} @endif" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="cDesc" class="form-label">Número de lote</label>
                    <input type="text" class="form-control" name="lote" value="@if($item->idSemilla>0) {{$item->nLote}} @endif" required>
                </div>
                <div class="mb-3 col-12">
                    <label for="cDesc" class="form-label">Proveedor</label>
                    <input type="text" class="form-control" name="prov" value="@if($item->idSemilla>0) {{$item->cProveedor}} @endif" required>
                </div>
            </div>

            
          
         
            <button id="btnEditar" type="submit" class="btn btn-primary">
        
            @if($item->idSemilla > 0)
                Actualizar
            @else
                Registrar
            @endif
        
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection