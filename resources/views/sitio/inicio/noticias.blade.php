<div class="secFuerte">
    <h2>
        <label class="titulo">Noticias</label>
    </h2>
    <div class="container text-center">

        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($noticias as $Noticia)
                <div class="col mt-3">
                    <div class="card bg-transparent" style="border:0;">
                        <div class="img-container">
                            <img src="{{asset('images/content/noticias').'/'.$Noticia->idNoticia.'.webp'}}" 
                            style="border:0;border-top-left-radius:3em;border-bottom-right-radius:5em;object-fit: cover;">
                        </div>
                    @if($Noticia->cLink)
                    <div class="card-img-overlay">
                        <button class="botonPequeno position-absolute bottom-0 end-0" type="button"'
                                onclick="javascript:window.open(' {{ $Noticia->cLink }}', '_blank' );">¡Conoce más!
                        </button>
                    </div>
                    @endif
                       
                    </div>
                    <div class="card-body">
                        <label class="texttitle mt-3">{{$Noticia->cNoticia}}</label><br>
                        <p class="textcard text-truncate">{{$Noticia->cContenido}}</p>
                    </div>
                </div>
            @endforeach


        </div>
    </div>



   <!-- Tu contenido aquí -->
    <div class="container mt-4">
        <div class="your-class">
            <div>
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <!-- Añade más tarjetas según sea necesario -->
        </div>
    </div>






</div>