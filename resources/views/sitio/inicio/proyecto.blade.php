<div class="secFuerte">
    <h2>
        <label class="titulo">PROYECTOS</label>
    </h2>
    <div class="container text-center">

        <div class="row row-cols-1 row-cols-md-3">
        @foreach ($proyectos as $proyecto)
            <div class="col mt-3">
                <div class="card bg-transparent" style="border:0;">
                    <div class="img-container">
                        <img src="{{asset('images/content/proyectos').'/'.$proyecto->idProyecto.'.webp'}}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:5em;object-fit: cover;">
                    </div>
                    <div class="card-img-overlay">
                        <button class="botonPequeno position-absolute bottom-0 end-0" type="button" style="border-top-left-radius:1em; border-bottom-right-radius:1em; justify-content: right;" 
                         onclick="window.location='{{ url('/proyecto/' . $proyecto->idProyecto) }}'">¡Conoce más!</button>
                    </div>
                </div>
                <div class="card-body">
                    <label class="texttitle mt-3">{{$proyecto->cNombre}}</label><br>
                    <p class="textcard text-truncate">{{$proyecto->cDescripcion}}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

