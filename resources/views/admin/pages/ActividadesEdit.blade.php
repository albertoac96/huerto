@extends('admin.main.admin')

@section('content')

<div class="secClara pt-4">
   

   <div class="seccionTipo2 pt-4">
   <button type="button" class="btn btn-primary btn-lg">
   <i class="fa fa-arrow-left" aria-hidden="true"></i>
   </button>
        <h2>ACTIVIDADES</h2>

        @if($idActividad>0)
        <form method="post" action="{{route('creaActividad')}}" onsubmit="showOverlay()" id="f1" enctype="multipart/form-data">
        @else
        <form method="post" action="{{route('upActividad')}}" id="f1" onsubmit="showOverlay()" enctype="multipart/form-data">
        @endif
            <?php
                if($id > 0){
                    //echo '<form method="post" action="actividadesEdit.php" id="f1">';
                    echo '<div class="mb-3 d-none"><input type="text" class="form-control" name="idActividad" value="'.$datos["idActividad"].'"></div>';
                } else {
                    //echo '<form method="post" action="actividadesEdit.php" id="f1">';
                    echo '<div class="mb-3 d-none"><input type="text" class="form-control" name="idActividad" value="0"></div>';
                }
            ?>
            <div class="mb-3">
                <label for="cActvidad" class="form-label">Nombre de la actividad</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $datos["cActividad"];?>" required>
            </div>
            <div class="mb-3">
                <label for="cLugar" class="form-label">Lugar de la actividad</label>
                <input type="text" class="form-control" name="lugar" value="<?php echo $datos["cLugar"];?>" required>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Descripción</label>
                <textarea class="form-control" name="desc" rows="3" required><?php echo $datos["cDescripcion"];?></textarea>
            </div>
            <div class="mb-3">
                <label for="cDesc" class="form-label">Fecha</label>
                <input type="date" name="fecha" step="1" min="2013-01-01" value="<?php echo $datos["dActividad"];?>" required>
            </div>
            <div class="row">
            <div class="mb-3 col-4">
                <?php 
                    if($id > 0){
                        echo '<img src="../../sitio/images/content/actividades/'.$datos["idActividad"].'.webp" class="d-block w-100" alt="...">';
                    } else {
                        echo '<img src="../../sitio/images/si.png" class="d-block w-100" alt="...">';
                    }
                ?>
                
            </div>
            <div class="mb-3 col-8">
                <label for="formFile" class="form-label">Suba una imagen</label>
                <input class="form-control" type="file" name="archivo" <?php if($id == 0) echo 'required';?>>
            </div>
            </div>

            <div class="mb-3">
                <label for="cLink" class="form-label">Link relacionado</label>
                <input type="text" class="form-control" name="link" value="<?php echo $datos["cLink"];?>" required>
            </div>

            <button type="submit" class="btn btn-primary" onclick="validarActividad()">
            <?php
                if($id > 0){
                    echo 'Editar actividad';
                } else {
                    echo 'Nueva actividad';
                }
            ?>
            </button>

         
            
        
            </form>
        </div>


          


</div>


@endsection