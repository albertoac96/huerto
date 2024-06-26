<div class="container-fluid secFuerte">



    <div class='container'>
        <h2>

            <label class="titulo">CARACTERÍSTICAS DE LA PLANTA</label></h2>

        <div class="container p-3" style="background-color:#F3F3F3;">
            
            <!-- Cabecera con título y nombre científico, más imagen -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-9">
                    <h1 class="pageTitle">{{ $planta->cNombre }}</h1>
                    <h6 class="categorySubtitle" id="nombreCientifico">{{ $planta->cNombreLatin }}</h6>
                </div>
                <div class="col-md-3 text-center">
                    <img id="imagen" class="rounded-circle mx-auto" style="height: 150px; width: 150px; object-fit: cover; border: 1px solid #7b9783;" src="{{ asset('images/content/catalogo/'.$planta->idPlanta.'.webp') }}">
                </div>
            </div>

            <!-- Fila de información general -->
            <div class="row" style="background-color: #7b9783; color: white;">
                <div class="col-12">
                    <h5 class="p-2">Información general</h5>
                </div>
            </div>

            <!-- Descripción, origen, aportación, beneficios -->
            <div class="row text-justify">
                <div class="col-md-6">
                    <h5 class="categoryTitle">Descripción</h5>
                    <p class="categorySubtitle">{{ $planta->cDescripcion }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Origen</h5>
                    <p class="categorySubtitle">{{ $planta->cOrigen }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Aportación</h5>
                    <p class="categorySubtitle">{{ $planta->cAportacion }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Beneficios</h5>
                    <p class="categorySubtitle">{{ $planta->cBeneficios }}</p>
                </div>
           

            <!-- Detalles específicos de la planta -->
           
                <div class="col-md-3">
                    <h5 class="categoryTitle">Grupo (Tipo)</h5>
                    <p class="categorySubtitle">{{ $planta->grupo }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Ciclo de vida</h5>
                    <p class="categorySubtitle">{{ $planta->cicloDeVida }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Crecimiento</h5>
                    <p class="categorySubtitle">{{ $planta->crecimiento }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Familia</h5>
                    <p class="categorySubtitle">{{ $planta->familia }}</p>
                </div>
              </div>

               <div class="row mt-3" style="background-color: #7b9783; color: white;">
                <div class="col-12">
                    <h5 class="p-2">Información de siembra</h5>
                </div>
            </div>

            <div class="row">
          

            <!-- Más información de cultivo y cuidados -->
          
                <div class="col-md-3">
                    <h5 class="categoryTitle">Profundidad de siembra</h5>
                    <p class="categorySubtitle">{{ $planta->zSiembra }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Profundidad de la raíz</h5>
                    <p class="categorySubtitle">{{ $planta->profRaiz }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Fijadora de nitrógeno</h5>
                    <i class="{{ $planta->fijNitro ? 'fas fa-check' : 'fas fa-xmark' }}" style="color: {{ $planta->fijNitro ? 'green' : 'red' }}; font-size: 50px;"></i>

                </div>
           

           
                <div class="col-md-3">
                    <h5 class="categoryTitle">Tipo de suelo</h5>
                    <p class="categorySubtitle">{{ $planta->tipoSuelo }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Humedad del suelo</h5>
                    <p class="categorySubtitle">{{ $planta->humSuelo }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">PH del suelo</h5>
                    @switch($planta->phSuelo)
    @case('Ácido (pH menor que 7)')
        <div class='d-inline-block bg-danger' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        @break

    @case('Ligeramente ácido (pH entre 6.1 y 6.5)')
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-warning' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        @break

    @case('Neutral (pH entre 6.6 y 7.3)')
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-success' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        @break

    @case('Ligeramente alcalino (pH entre 7.4 y 7.8)')
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-primary' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        @break

    @case('Alcalino (pH mayor que 7)')
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-light' style='width:50px;height:25px;margin:5px;'></div>
        <div class='d-inline-block bg-dark' style='width:50px;height:25px;margin:5px;'></div>
        @break

    @default
        
@endswitch

<p class='categorySubtitle' style='text-align:center;'>{{ $planta->phSuelo }}</p>

                </div>
            </div>


           <!-- Fila de información general -->
             <div class="row mt-3" style="background-color: #7b9783; color: white;">
                <div class="col-12">
                    <h5 class="p-2">Información de cultivo</h5>
                </div>
            </div>
          

          <div class="row">
                <div class="col-md-3">
                    <h5 class="categoryTitle">Tiempo de germinación</h5>
                    <p class="categorySubtitle">{{ $planta->tGerminacion }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Tiempo de germinación a la primera cosecha</h5>
                    <p class="categorySubtitle">{{ $planta->firstCosecha }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Periodicidad de la cosecha</h5>
                     <p class="categorySubtitle">{{ $planta->cicloCosecha }}</p>
                </div>
           


           
                <div class="col-md-3">
                    <h5 class="categoryTitle">Altura de la planta</h5>
                    <p class="categorySubtitle">{{ $planta->altura }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Ancho de la planta </h5>
                    <p class="categorySubtitle">{{ $planta->ancho }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Espaciamiento entre plantas</h5>
                    <p class="categorySubtitle">{{ $planta->distPlantas }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Dimensiones de las hojas</h5>
                    <p class="categorySubtitle">{{ $planta->dimHojas }}</p>
                </div>
           

            <!-- Información del PH del suelo y otros cuidados -->
          
                <div class="col-md-6">
                    <h5 class="categoryTitle">Mejor temporada para sembrar</h5>
                   <div class="row">
                         @php
                            $temporadas = explode(",",$planta->tempSiembra);
                         
                            @endphp
                        
                             <div class="estacion col-3">
                                <i class="fas fa-seedling fa-3x m-1" style="color: {{ in_array('Primavera', $temporadas) ? '#1FAD44' : '#ccc' }};"></i>
                                <div>Primavera</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-sun fa-3x m-1" style="color: {{ in_array('Verano', $temporadas) ? '#CC761A' : '#ccc' }};"></i>
                                <div>Verano</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-leaf fa-3x m-1" style="color: {{ in_array('Otoño', $temporadas) ? '#ffcc00' : '#ccc' }};"></i>
                                <div>Otoño</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-snowflake fa-3x m-1" style="color: {{ in_array('Invierno', $temporadas) ? '#1AA4CC' : '#ccc' }};"></i>
                                <div>Invierno</div>
                            </div>
                         
                         

                    </div>
                </div>
                <div class="col-md-6">
                    <h5 class="categoryTitle">Mejor temporada para cosechar</h5>
                    <div class="row">
                         @php
                            $temporadas = explode(",",$planta->tempCosecha);
                         
                            @endphp
                        
                             <div class="estacion col-3">
                                <i class="fas fa-seedling fa-3x m-1" style="color: {{ in_array('Primavera', $temporadas) ? '#1FAD44' : '#ccc' }};"></i>
                                <div>Primavera</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-sun fa-3x m-1" style="color: {{ in_array('Verano', $temporadas) ? '#CC761A' : '#ccc' }};"></i>
                                <div>Verano</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-leaf fa-3x m-1" style="color: {{ in_array('Otoño', $temporadas) ? '#ffcc00' : '#ccc' }};"></i>
                                <div>Otoño</div>
                            </div>
                            <div class="estacion col-3">
                                <i class="fas fa-snowflake fa-3x m-1" style="color: {{ in_array('Invierno', $temporadas) ? '#1AA4CC' : '#ccc' }};"></i>
                                <div>Invierno</div>
                            </div>
                         
                         

                    </div>
                </div>
            </div>

           <!-- Fila de información general -->
             <div class="row mt-3" style="background-color: #7b9783; color: white;">
                <div class="col-12">
                    <h5 class="p-2">Cuidados</h5>
                </div>
            </div>

            <!-- Información de cuidados: riego, iluminación, temperatura -->
            <div class="row">
                <div class="col-md-3">
                    <h5 class="categoryTitle">Cantidad de riego</h5>
                    <p class="categorySubtitle">{{ $planta->tRiego }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Iluminación del cultivo</h5>
                    <p class="categorySubtitle">{{ $planta->cIluminacion }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Temperatura mínima</h5>
                    <p class="categorySubtitle">{{ $planta->tempMin }}</p>
                </div>
                <div class="col-md-3">
                    <h5 class="categoryTitle">Temperatura máxima</h5>
                    <p class="categorySubtitle">{{ $planta->tempMax }}</p>
                </div>
            </div>
        </div>








    </div>





</div>


<style>
.categorySubtitle {
  width: auto;
  margin: 0;
  padding: 5px 16px;
  text-align: justify;
  color: #313d03;
  font-size: 18px;
}

#nombreCientifico {
  font-style: italic;
}

.categoryTitle {
  width: auto;
  margin: 0;
  padding: 10px 16px;
  text-align: left;
  color: black;
  font-size: 20px;
}
.pageTitle {
  width: auto;
  margin: 0;
  padding: 10px 16px;
  text-align: left;
  color: #313d03;
  line-height: 25px;
}
</style>
