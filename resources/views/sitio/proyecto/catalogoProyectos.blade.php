 <div class="text-center secClara">
     <h2>
         <label class="titulo">PROYECTOS</label>
         <blockquote class="blockquote mb-0">
             <p>"En la investigación es incluso más importante el proceso que el logro mismo"</p>
            
         </blockquote>
     </h2>
     <div class="row row-cols-1 row-cols-md-3">

        @foreach ($proyectos as $proyecto)
         <div class="col mt-3">
             <div class="card bg-transparent" style="border:0;">
                 <div class="img-container">
                     <img src="{{asset('images/content/proyectos').'/'.$proyecto->idProyecto.'.webp'}}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:3em;object-fit: cover;">
                 </div>
                 <div class="card-img-overlay">
                     <button class="botonPequeno position-absolute bottom-0 end-0" type="button" onclick="window.location='{{ url('/proyecto/' . $proyecto->idProyecto) }}'">¡Conoce más!</button>
                 </div>
             </div>
             <div class="card-body">
                 <label class="texttitle mt-3">{{$proyecto->cNombre}}</label><br>
                 <label class="textcard">{{$proyecto->cDescripcion}}</label>
             </div>
         </div>
        @endforeach  

     </div>

      <div class="d-flex justify-content-center mt-3">
          <!-- Paginación para Capacitaciones -->
{{ $proyectos->links('vendor.pagination.bootstrap-5') }}

</div>
 </div>
