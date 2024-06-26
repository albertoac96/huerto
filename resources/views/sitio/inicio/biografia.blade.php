<div class="secClara d-none d-sm-block d-md-block">
    <div class="seccionTipo2 container" style="margin-bottom:5em">
        <h2>{{$biografia[0]->cTitulo}}</h2>
        <p style="margin-right:1vh;margin-left:1vh;margin-bottom:5vh">{{$biografia[0]->cContenido}}</p>
        <figure class="position-absolute start-50 translate-middle" style="margin-top:10vh">
            <center>
            <img src="{{asset('images/content/bios').'/'.$biografia[0]->idBiografia.'.webp'}}" class="img-fluid rounded-start" width="250px" alt="...">
            </center>
        </figure>
    </div>      
</div>