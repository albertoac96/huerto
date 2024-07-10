<div class="secClara">
    <h2>
        <label class="titulo">PRÓXIMOS EVENTOS</label>
    </h2>
    <div class="container text-center">

        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($eventos as $evento)
            <div class="col mt-3">
                <div class="card bg-transparent" style="border:0;">
                    <div class="img-container">
                        <img src="{{asset('images/content/eventos').'/'.$evento->idEvento.'.webp'}}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:5em;object-fit: cover;">
                    </div>
                    @if($evento->cLink)
                    <div class=" card-img-overlay">
                        <button class="botonPequeno position-absolute bottom-0 end-0" type="button"'
                            onclick="javascript:window.open(' {{ $evento->cLink }}', '_blank' );">¡Conoce más!
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <label class="mt-3"><b>{{ $FechaCorta($evento->dEvento) }} </b></label><br>
                    <label class="texttitle mt-3">{{ $evento->cEvento  }}</label><br>

                    <p class="textcard text-truncate">{{ $evento->cDescripcion }} </p>
                </div>
            </div>
            @endforeach


        </div>
      
        <a href="{{ route('showEventos') }}" class="btn botonPequeno">Ver más eventos</a>

    </div>
</div>
