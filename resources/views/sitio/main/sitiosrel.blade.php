<div class="container-fluid secClara">
    <h2>
        <label class="titulo">SITIOS RELACIONADOS</label>
    </h2>


    <div class="container contenedor text-center">
        <div class="row">
            <div class="col">
                <img class="imagen" src="{{url('images/logos/iniat.png')}}" style="height: auto; max-height: 100px;  max-width: 100%; vertical-align: middle; position: relative; top: 50%; transform: translateY(-50%);" alt="Logo del Iniat">
            </div>
        </div>

        <div class="row row-cols-6 align-middle">
           
        @foreach ($sitiosrel as $item)
            <div class="col p-3">
            <a href="{{$item->cURL}}" target="_blank">
            <img class="imagen" src="{{asset('images/logos').'/'.$item->cImg}}" style="height: auto; max-height: 150px;  max-width: 100%; vertical-align: middle; position: relative; top: 50%; transform: translateY(-50%);">
            </a>
            </div>
        @endforeach


        </div>
    </div>




</div>


<style>


.contenedor:hover .imagen {
    transform: scale(1.2); /* aumenta el tamaño de la imagen al pasar el mouse */
}

</style>