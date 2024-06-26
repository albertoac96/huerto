<div class="container-fluid secClara">
        <div class="container text-center">
            <h2>
                
                <label class="titulo">ACTIVIDADES</label>
                <blockquote class="blockquote mb-0">
                    <p>Quién sabe lo que siembra, no le teme a lo que cosecha</p>
                  
                  
        
                </blockquote>
            </h2>
           


    <div class="text-center" >
        <div class="row row-cols-1 row-cols-md-3">
    
      @foreach($actividades as $item)
            <div class="col mt-3">
                <div class="card h-100" style="border-top-left-radius:3em;border-bottom-right-radius:2em; background-color: #F2E4C5; border: 0px">
                    <div class="card-body">
                    
                        <div class="img-container mb-3">
                        <img src="{{asset('images/content/actividades').'/'.$item->idActividad . '.webp' }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        @if($item->cLink)
                            <div class="card-img-overlay">
                            <button class="botonPequeno position-absolute top-0 end-0" type="button"
                            onclick="javascript:window.open('{{ $item->cLink }}', '_blank');">¡Conoce más!</button></div>
                        @endif
                        <h5 class="card-title">{{$item->cActividad}}</h5>
                        <label><i>{{$item->cLugar}}</i></label><br>
                        <label><b>Fecha: </b>
                        {{$item->dActividad}}</label><br>
                        <label style="text-align: justify;">{{$item->cDescripcion}}</label>
                    </div>
                </div>
            </div>
          @endforeach
        </div>      



         </div>
     


    </div>

</div>