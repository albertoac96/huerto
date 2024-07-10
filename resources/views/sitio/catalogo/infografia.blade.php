<div class="secClara">
    <h2>
        <label class="titulo">INFOGRAFÍA INTERACTIVA DE LOS CULTIVOS</label>
    </h2>
    <p>
        A través de nuestro mapa interactivo, conocerás las camas de cultivo<br>
        ¡Conócelas dando click en cada uno de los iconos!




    </p>

    <div class="container">

        <div class="row contenedorcama">
            <!-- contenedor para la infografía -->
            <div class="col-md-6">

                @include("sitio.catalogo.infografia.verInfografia")

            </div>



            <!-- contenedor para los recuadros con la info de la cama -->

            <div class="card border-success mb-3" style="max-width: 25rem;max-height: 15rem; background-color: #F2E4C5;">
                <div class="card-header bg-transparent border-success">
                    <h5 class="texttitle">Camas de cultivo</h5>
                </div>
                <div class="card-body text-success text-center">
                    <p class="card-text text-center">
                        <table class="tablainfogeneral">
                            <tbody>
                             @foreach($contenedores as $item)
                                <tr>
                                    <th style="width:50%;">{{$item->cContenedor}} </th>
                                    <th class="center-text">{{$item->contenedoresTotal}}</th>
                                </tr>
                                
                            @endforeach
                                
                            </tbody>
                        </table>
                    </p>
                </div>

            </div>





        </div>
    </div>
</div>

</div>

@section('estilos')
<style>
.center-text {
    text-align: center;
}
</style>
@endsection

@section('js')

<script>
$(document).ready(function() {
    $('g').filter(function() {
  return $(this).attr('data-value') ;
}).click(function() {
  
    $('#loading-overlay').show();
    var modalBody = "";
     $('#infoModal').html(modalBody);
    var value = $(this).attr("data-value");
    if(value === undefined){
        return;
    }
    console.log(value);
    let title = 'Cama ' + value;
    $('#tituloCama').text(title);
    $.ajax({
      url: "catalogo/infoCama/"+value,
      method: "GET",
      success: function(response) {
        $('#modal').modal('show');
        console.log(response);
        $('#loading-overlay').hide();
        
        modalBody = '<p><b>Experimento(s):</b> ';
        if(response.exps.length == 0 || response.exps[0].idExperimento == null){
            modalBody += 'Sin experimentos';
        } else {
            response.exps.forEach(function(exp) {
                modalBody += `${exp.cExperimento}`;
            });
        }
        modalBody += "</p>";

        modalBody += '<p><b>Encargado(s):</b> ';
        if(response.user.length == 0 || response.user[0].nombre == null){
            modalBody += 'Sin encargado';
        }else{
            response.user.forEach(function(us) {
                modalBody += `<a href="${us.cLink}" target="_blank" style="color:black;">${us.nombre} `;
                modalBody += `${us.apellido} </a>`;
            });
        }
        modalBody += "</p>";

        modalBody += '<p><b>Planta(s):</b> ';
        if(response.plantas.length == 0 || response.plantas[0].idPlanta == null){
             modalBody += 'Sin plantas';
        }else{
             modalBody += '<div class="row row-cols-3">';
             response.plantas.forEach(function(planta) {
                modalBody += '<div class="col"><div class="img-circle mt-2">';
                modalBody += `<img src="../images/content/catalogo/${planta.idPlanta}.webp" class="img-fluid rounded-circle" alt="..."></div>`
                modalBody += `<center><a class="textcard2" href="planta/${planta.idPlanta}">${planta.cNombre}</a></center></div>`
            });
            modalBody += "</div>";
        }
        modalBody += "</p>";



         
        console.log(modalBody);

        $('#infoModal').html(modalBody);
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log("AJAX request failed: " + textStatus + " " + errorThrown);
        $('#loading-overlay').hide();
      }
    });
    
  });
});
</script>
@endsection
