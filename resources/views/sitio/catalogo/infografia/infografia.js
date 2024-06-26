<script>
$(document).ready(function(){
  $('#area-one-zoom').click(function(){
    $.ajax({
      url: '/ruta-de-tu-api',  // Ajusta a la ruta de tu API o endpoint
      type: 'GET',
      success: function(data) {
        // Llena el modal con la información obtenida
        //$('.modal-body').html(data);
        // Muestra el modal
        $('#mcama1').modal('show');
      }
    });
  });
});
</script>