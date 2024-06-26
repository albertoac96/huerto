<div class="secFuerte">
    <h2>
        <label class="titulo">Tutorial</label>
    </h2>

    <div class="row row-cols-1 row-cols-md-3 container-fluid">
        @foreach($tutoriales as $tutorial)
        <div class="col mt-3">
                <div class="card h-100" style="border-top-left-radius:3em;border-bottom-right-radius:2em; background-color: #F2E4C5; border: 0px">
                    <div class="card-body">
                        <div class="img-container mb-3">
                        @if($tutorial->cMultimedia)
                            <div style="object-fit: cover;"> 
                                
                            {!!$tutorial->cMultimedia!!}
                                
                            </div>
                        @else 
                            <img src="../images/content/capacitaciones/{{ $tutorial->idCapacitacion . '.' . $tutorial->cExt }}" class="img-fluid rounded-start" alt="..." style="object-fit: cover;">
                         @endif
                        </div>

                        @if($tutorial->cLink)
                            <div class="card-img-overlay">
                                <button class="botonPequeno position-absolute top-0 end-0" type="button" onclick="javascript:window.open('{{ $tutorial->cLink }}', '_blank');">¡Conoce más!</button>
                            </div>
                        @endif

                        <h5 class="card-title">{{ $tutorial->cCapacitacion }}</h5>
                        <label><i>{{ $tutorial->cLugar }}</i></label><br>
                        <label><b>Tipo: </b>{{ $tutorial->cTipo }}</label><br>
                        <label><b>Fecha: </b>{{ $tutorial->dCapacitacion }}</label><br>
                        <label class="m-3" style="text-align: justify;">{{ $tutorial->cDescripcion }}</label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
