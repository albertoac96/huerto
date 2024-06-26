<div class="secClara">

    <h2>
   
        <label class="titulo">COLABORADORES DEL HUERTO</label>
    </h2>


    <div class="container text-center">

        <div class="row row-cols-1 row-cols-md-4">

    @foreach($colaboradores as $item)
      
               
                    <div class="col mt-3">
                        <div class="card bg-transparent" style="border:0;">
                            <div class="img-container">
                                <img src="{{ asset('images/content/colaboradores/' . $item->idUsuario . '.' . $item->cExt) }}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:3em;object-fit: cover;">
                            </div>
                           
                                <div class="card-img-overlay">
                                <button class="botonPequeno position-absolute bottom-0 end-0" type="button"
                                onclick="javascript:window.open('{{ $item->cLink }}', '_blank');">¡Conoce más!</button></div>
                          
                        </div>
                        <div class="card-body">
                            <label class="card-title">{{$item->nombre}} {{$item->apellido}}</label><br>
                            <label class="card-text">{{$item->escolaridad}}</label><br>
                            
                                <label class="card-text">{{$item->comunidadIbero}}</label><br>
                          
                           
                                <label class="card-text">{{$item->otraInstitucion}}</label><br>
                        </div>
                    </div>
              

         @endforeach

        </div>

        
    </div>

</div>