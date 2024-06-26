@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')

  <div class="container-fluid secClara">
                   <div class='container'><h2 class='titulo'>{{$data->proyecto->cNombre}}</h2>
                   <p><b>Fecha del proyecto: </b>.FechaFtoCorto($datos["dInicio"])."</p>
                   <h4 class='texttitle'>Descripción</h4>
                   <label class='textcard m-3'>.$datos["cDescripcion"]."</label>

                   <div class='row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 m-2 mt-4'><div class='col-6'>
                   <h4 class='texttitle'>Problemática</h4>
                   <label class='textcard m-2'>.$datos["cProblematica"]."</label></div>
                   <div class='col-6'><h4 class='texttitle'>Incidencia</h4>
                   <label class='textcard m-2'>.$datos["cIncidencia"]."</label></div></div>

                   <h4 class='texttitle mt-4'>Responsable</h4>
                    
                        <center><div class="col-3 mt-2"></div>
                            <div class="card bg-transparent" style="border:0">
                                <div class="img-container">
                                    <img src="../images/content/colaboradores/'.$datos['idUsuario'].'.'.$datos['cExt'].'" style="border:0border-top-left-radius:3emborder-bottom-right-radius:3em">
                                </div>
                                if($datos['cLink']){
                                    <div class="card-img-overlay">
                                    <button class="botonPequeno position-absolute bottom-0 end-0" type="button"'
                                    onclick="javascript:window.open(\''.$datos['cLink'].'\', \'_blank\')">¡Conoce más!</button></div>
                                }
                            </div>
                            <div class="card-body">
                           <label class='textcard'>.$datos['nombre']." ".$datos['apellido']."</label>
                                <label class="card-text">.$datos['escolaridad'].'</label><br>
                                if($datos['comunidadIbero']){
                                    <label class="card-text"><b>.$datos['comunidadIbero'].'</b></label><br>
                                }
                                if($datos['otraInstitucion']){
                                    <label class="card-text">.$datos['otraInstitucion'].'</label><br>
                                }
                                <p class="textcard text-truncate">.$datos['cDescripcion'].'</p>
                            </center></div>
                        </div>
                   </div>
               
      


</div>


@endsection