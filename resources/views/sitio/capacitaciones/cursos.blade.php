<div class="secClara">
    <h2>
        <label class="titulo">Cursos y talleres</label>
        <blockquote class="blockquote mb-0">
            <p>Quién sabe lo que siembra, no le teme a lo que cosecha</p>
          
        </blockquote>
    </h2>

    <div class="row row-cols-1 row-cols-md-3 container-fluid">
    @foreach($capacitaciones as $curso)
        <div class="col mt-3">
            <div class="card h-100" style="border-top-left-radius:3em;border-bottom-right-radius:2em; background-color: #F2E4C5; border: 0px">
                <div class="card-body">
                    <div class="img-container mb-3">
                        @if($curso->cMultimedia)
                            <div>
                            
                                {!! $curso->cMultimedia !!}
                           
                            </div>
                        @else
                            <img src="../images/content/capacitaciones/{{ $curso->idCapacitacion }}.{{ $curso->cExt }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover;">
                        @endif
                    </div>

                    @if($curso->cLink)
                        <div class="card-img-overlay">
                            <button class="botonPequeno position-absolute top-0 end-0" type="button" onclick="javascript:window.open('{{ $curso->cLink }}', '_blank');">¡Conoce más!</button>
                        </div>
                    @endif

                    <h5 class="card-title">{{ $curso->cCapacitacion }}</h5>
                    <label><i>{{ $curso->cLugar }}</i></label><br>
                    <label><b>Tipo: </b>{{ $curso->cTipo }}</label><br>
                    <label><b>Fecha: </b>{{$curso->dCapacitacion }}</label><br>
                    <label class="m-3" style="text-align: justify;">{{ $curso->cDescripcion }}</label>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


 
