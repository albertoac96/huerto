  
        <div class="text-center secFuerte">
            <h2>
             <label class="titulo">CONTACTO</label>
                <blockquote class="blockquote mb-0">
                    <p>Quién sabe lo que siembra, no le teme a lo que cosecha</p>
                  
                </blockquote>
            </h2>

         
                    <div class="row mb-5">
                        <div class="col-12 col-md-6">

                           
                       
                                    <img src="../images/mapa_campus_ibero.png" class="rounded-start img-fluid" alt="..." style="width: 600px;">
                             
                                <p>
                                <label class="subtitulo"><b>Huerto: </b> localizado entre las puertas 4 y 5.</label><br>



                                <label class="subtitulo"><b>Tel.</b> +52 (55) 5950-4000 y 9177-4400</label><br>




                                <label class="subtitulo"><b>Ubicación del iniat: </b>Edificio M, 1er piso</label><br>




                                <label class="subtitulo"><b>Correo : </b>iniat@ibero.mx</label><br>



                                <label class="subtitulo mb-4">Prolongación Paseo de Reforma 880, Lomas de Santa Fe, México, C.P. 01219, Ciudad de México.</label>

                                </p>

                          

                        </div>
                        <!-- Primera fila segunda  columna  -->
                        <div class="col-12 col-md-6">
                            <div class="card h-100 p-5" style="border-top-left-radius:3em; border-bottom-right-radius:2em; background-color: #F2E4C5;">
                                <div class="card-body">
                                    <h5 class="card-title">Para ponerse en contacto con el Huerto Ibero,por favor llene el formulario con su información</h5>
                                    <form method="POST" action="{{route('FormContacto')}}" id="f1" class="row g-3">
                                     @csrf
                                        <div class="col-12 col-md-6">
                                            <label for="inputNombre" class="form-label"><b>Nombre</b></label>
                                            <input type="text" class="form-control" name="name" placeholder="Ingrese su nombre" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="inputApellido" class="form-label"><b>Apellido</b></label>
                                            <input type="text" class="form-control" name="apellido" placeholder="Ingrese su apellido" required>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label for="inputTelefono" class="form-label"><b>Teléfono</b></label>
                                            <input type="tel" class="form-control" name="tel" placeholder="Ingrese un número de teléfono">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="inputEmail" class="form-label"><b>Email</b></label>
                                            <input type="email" class="form-control" name="mail" placeholder="Ingrese un email, por favor" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputComentarios" class="form-label"><b>Mensaje</b></label>
                                            <textarea class="form-control" name="msj" rows="4" placeholder="Por favor ingrese su mensaje" required></textarea>
                                        </div>

                                       
                                         {!! htmlFormSnippet() !!}

                                         @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


                                        <div class="col-12">

                                            <button type="submit" class="btn btn-success btn-bottom-right btn-lg" type="button" style="border-top-left-radius:1em; 
                                            border-bottom-right-radius:1em; justify-content: right;">Enviar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <!-- Segunda fila -->
                    <div class="row">
                        <!-- Segunda fila primera columna -->
                        <div class="col-12">
                            <!-- Aquí va el mapa -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3161.594084835443!2d-99.26295232256649!3d19.37177141576139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d201aa7747afeb%3A0x1ba053d8c73db3fe!2sIbero%20Puerta%205!5e0!3m2!1ses-419!2smx!4v1720578448127!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                           

                        </div>
                    </div>
              
        </div>