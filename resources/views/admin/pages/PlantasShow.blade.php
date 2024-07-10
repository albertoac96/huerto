@extends('admin.main.admin')

@section('content')


<div class="secClara">
    <h2>PLANTAS</h2>

    <div class="text-end">
        <button type="button" class="btn btn-primary mb-3" onclick="newPlanta(0)">Nueva Planta</button>
    </div>
    <table class="table table-sm" id="tablePlantas">
        <thead class="table-success">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre Latín</th>
                <th scope="col">Especie</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr class="text-center">
                <th>{{$item->idPlanta}}</th>
                <th>{{$item->cNombre}}</th>
                <th class="fs-6 fw-lighter">{{$item->cNombreLatin}}</th>
                <th class="fs-6 fw-lighter">{{$item->cEspecie}}</th>
                <th class="fs-6 fw-lighter">

                    <button id="btnVer" type="button" class="btn btn-outline-info" onclick="ver({{$item}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa fa-info-circle" aria-hidden="true"></i></button>

                    <button id="btnFormulario" type="button" class="btn btn-warning m-2" onclick="upPlanta({{$item->idPlanta}})">
                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button id="btnEliminar" type="button" class="btn btn-danger" onclick="delPlanta({{$item->idPlanta}})">
                        <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>




    <!-- Modal -->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Detalles de planta</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: left;">
                    <label><b>Creador por: </b></label>
                    <label id="cCreador"></label><br>
                    <label><b>Fecha de creación: </b></label>
                    <label id="created_at"></label>


                    <div class="container p-3" style="background-color:#F3F3F3;">

                        <!-- Cabecera con título y nombre científico, más imagen -->
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-9">
                                <h1 class="pageTitle" id="cNombre"></h1>
                                <h6 class="categorySubtitle" id="cNombreLatin"></h6>
                                <h6 class="categorySubtitle" id="cOtrosNombres"></h6>
                            </div>
                            <div class="col-md-3 text-center">
                                <img id="imagen" class="rounded-circle mx-auto" style="height: 150px; width: 150px; object-fit: cover; border: 1px solid #7b9783;" src="">
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
                                <p class="categorySubtitle" id="cDescripcion"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Origen</h5>
                                <p class="categorySubtitle" id="cOrigen"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Aportación</h5>
                                <p class="categorySubtitle" id="cAportacion"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Beneficios</h5>
                                <p class="categorySubtitle" id="cBeneficios"></p>
                            </div>


                            <!-- Detalles específicos de la planta -->

                            <div class="col-md-3">
                                <h5 class="categoryTitle">Grupo (Tipo)</h5>
                                <p class="categorySubtitle" id="grupo"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Ciclo de vida</h5>
                                <p class="categorySubtitle" id="cicloDeVida"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Crecimiento</h5>
                                <p class="categorySubtitle" id="crecimiento"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Familia</h5>
                                <p class="categorySubtitle" id="familia"></p>
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
                                <p class="categorySubtitle" id="zSiembra"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Profundidad de la raíz</h5>
                                <p class="categorySubtitle" id="profRaiz"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Fijadora de nitrógeno</h5>
                                <p class="categorySubtitle" id="fijNitro"></p>

                            </div>



                            <div class="col-md-3">
                                <h5 class="categoryTitle">Tipo de suelo</h5>
                                <p class="categorySubtitle" id="tipoSuelo"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Humedad del suelo</h5>
                                <p class="categorySubtitle" id="humSuelo"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">PH del suelo</h5>
                                <p class='categorySubtitle' id="phSuelo"></p>
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
                                <p class="categorySubtitle" id="tGerminacion"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Tiempo de germinación a la primera cosecha</h5>
                                <p class="categorySubtitle" id="firstCosecha"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Periodicidad de la cosecha</h5>
                                <p class="categorySubtitle" id="cicloCosecha"></p>
                            </div>




                            <div class="col-md-3">
                                <h5 class="categoryTitle">Altura de la planta</h5>
                                <p class="categorySubtitle" id="altura"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Ancho de la planta </h5>
                                <p class="categorySubtitle" id="ancho"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Espaciamiento entre plantas</h5>
                                <p class="categorySubtitle" id="distPlantas"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Dimensiones de las hojas</h5>
                                <p class="categorySubtitle" id="dimHojas"></p>
                            </div>


                            <!-- Información del PH del suelo y otros cuidados -->

                            <div class="col-md-6">
                                <h5 class="categoryTitle">Mejor temporada para sembrar</h5>
                                <p class="categorySubtitle" id="tempSiembra"></p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="categoryTitle">Mejor temporada para cosechar</h5>
                                <p class="categorySubtitle" id="tempCosecha"></p>
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
                                <p class="categorySubtitle" id="tRiego"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Iluminación del cultivo</h5>
                                <p class="categorySubtitle" id="cIluminacion"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Temperatura mínima</h5>
                                <p class="categorySubtitle" id="tempMin"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="categoryTitle">Temperatura máxima</h5>
                                <p class="categorySubtitle" id="tempMax"></p>
                            </div>
                        </div>



                        <div class="row mt-3" style="background-color: #7b9783; color: white;">
                            <div class="col-12">
                                <h5 class="p-2">Contenedores relacionados (<span id="contRel"></span>)</h5>
                                
                            </div>
                        </div>


                        <div class="row">
                            
<div id="accordionContainer" class="container"></div>




                </div>










            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>

            </div>
        </div>
    </div>
</div>




</div>
@endsection


@section('js')

<script>
    $(document).ready(function() {
        $('#tablePlantas').DataTable({
            responsive: true
            , language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            }
            , autoWidth: false
            , pageLength: 5
            , lengthMenu: [
                [5, 10, 20, -1]
                , [5, 10, 20, "Todos"]
            ]
        });

    });

    function delPlanta(userId) {
        console.log(userId);
        if (confirm("¿Estás seguro de que deseas eliminar esto?")) {
            var baseUrl = '{{ route("delPlanta", ["id" => "_id_"]) }}';

            document.getElementById('overlay').style.display = 'flex';
            var userUrl = baseUrl.replace('_id_', userId);

            // Redirigir para eliminar el usuario
            window.location = userUrl;

        }

    }

    function upPlanta(userId) {
        var baseUrl = '{{ route("formPlanta", ["id" => "_id_"]) }}';

        document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

    function newPlanta(userId) {
        var baseUrl = '{{ route("formPlanta", ["id" => "_id_"]) }}';

        document.getElementById('overlay').style.display = 'flex';
        var userUrl = baseUrl.replace('_id_', userId);

        window.location = userUrl;
    }

    function ver(item) {
        console.log(item);
        document.getElementById('overlay').style.display = 'flex';
        var baseUrl = "{{ asset('images/content/catalogo/') }}";
        baseUrl = `${baseUrl}/${item.idPlanta}.webp`;
        document.getElementById('imagen').src = baseUrl;
        document.getElementById('cCreador').textContent = item.name;
        document.getElementById('created_at').textContent = fechaCorta(item.created_at);
        document.getElementById('cNombre').textContent = item.cNombre;
        document.getElementById('cNombreLatin').textContent = item.cNombreLatin;
        document.getElementById('cOtrosNombres').textContent = item.cOtrosNombres;
        document.getElementById('cDescripcion').textContent = item.cDescripcion;
        document.getElementById('cOrigen').textContent = item.cOrigen;
        document.getElementById('cAportacion').textContent = item.cAportacion;
        document.getElementById('cBeneficios').textContent = item.cBeneficios;

        document.getElementById('grupo').textContent = item.grupo;
        document.getElementById('cicloDeVida').textContent = item.cicloDeVida;
        document.getElementById('crecimiento').textContent = item.crecimiento;
        document.getElementById('familia').textContent = item.familia;
        document.getElementById('zSiembra').textContent = item.zSiembra;
        document.getElementById('profRaiz').textContent = item.profRaiz;
        document.getElementById('fijNitro').textContent = item.fijNitro;

        document.getElementById('tipoSuelo').textContent = item.tipoSuelo;
        document.getElementById('humSuelo').textContent = item.humSuelo;
        document.getElementById('phSuelo').textContent = item.phSuelo;
        document.getElementById('tGerminacion').textContent = item.tGerminacion;
        document.getElementById('firstCosecha').textContent = item.firstCosecha;
        document.getElementById('cicloCosecha').textContent = item.cicloCosecha;

        document.getElementById('altura').textContent = item.altura;
        document.getElementById('ancho').textContent = item.ancho;
        document.getElementById('distPlantas').textContent = item.distPlantas;
        document.getElementById('dimHojas').textContent = item.dimHojas;
        document.getElementById('tempSiembra').textContent = item.tempSiembra;
        document.getElementById('tempCosecha').textContent = item.tempCosecha;

        document.getElementById('tRiego').textContent = item.tRiego;
        document.getElementById('cIluminacion').textContent = item.cIluminacion;
        document.getElementById('tempMin').textContent = item.tempMin;
        document.getElementById('tempMax').textContent = item.tempMax;

        fetch('/admin/plantas/info/' + item.idPlanta)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.length>0){
                    crearAcordeones(data);
                   
                }

                 document.getElementById('contRel').textContent = data.length;
                
                document.getElementById('overlay').style.display = 'none';
            })
            .catch(error => console.error('Error:', error));
    }

    function crearAcordeones(data) {
    const container = document.getElementById('accordionContainer');
    container.innerHTML = ''; // Limpiar el contenedor si ya contiene datos

    data.forEach((item, index) => {
        const cardHtml = `
            <div class="accordion" id="acordionCont-${index}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading${index}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="true" aria-controls="collapse${index}">
                            ${item.contenedor}
                        </button>
                    </h2>
                    <div id="collapse${index}" class="accordion-collapse collapse ${index === 0 ? 'show' : ''}" aria-labelledby="heading${index}" data-bs-parent="#accordionContainer">
                        <div class="accordion-body">
                         <a href="/admin/contenedor/plantas/show/${item.idContenedor}" style="color: blue; text-decoration: underline;" target="_blank">
                                Ver contenedor
                            </a><br>
                            <span><b>Tipo de contenedor: </b></span>${item.tipoc}<br>
                            <span><b>Estatus: </b></span>${item.cEstatus}<br>
                            <span><b>Creado por: </b></span>${item.creador}<br>
                            <span><b>Experimento: </b></span>${item.cExperimento}<br>
                            <span><b>Registros en bitacora: </b></span>
                            <a href="/admin/contenedor/bitacora/show/${item.idRel}" style="color: blue; text-decoration: underline;" target="_blank">
                                ${item.bitacoras_count}
                            </a><br>
                            <span><b>Nota: </b></span>${item.cNota}<br>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.innerHTML += cardHtml; // Agregar el acordeón al contenedor
    });
}


</script>

@endsection




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
