function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}          
var usuariosExperimento = new Array();
var usuariosID = new Array();


function fnClick(id){
    console.log("cama: "+id);
   }



function addUsuario(){
    // leemos el usuario seleccionado
    var usuario = document.getElementById("usuario").value;
    if (usuario != ""){
        //ubicamos la posición de los guiones en el string de la variable usuario
        var n1 = usuario.indexOf("-");
        var n2 = usuario.lastIndexOf("-");

        var id = usuario.substring(0, n1);
        usuariosID.push(id);  //ingresamos el id rescatado al arreglo usuariosID

        var nombre = usuario.substring(n1+1, n2-1);
        usuariosExperimento.push(nombre);

        var listado = "";
        for (var i=0; i<usuariosExperimento.length; i++){
            listado += "<li>"+usuariosExperimento[i]+" <button type='button' class='botonesMenu2' onClick='eliminarUsuario("+i+")'><i class='fas fa-minus-circle'></i> eliminar usuario</button></li>";
        }

        document.getElementById("participantes").innerHTML = listado;
    }
}

function eliminarUsuario(index){
    //eliminamos el usuario de usuariosExperimentos y su id de usuariosID
    usuariosID.splice(index, 1);
    usuariosExperimento.splice(index, 1);

    //rehacemos la lista de usuarios para verlos en la página
    var listado = "";
    for (var i=0; i<usuariosExperimento.length; i++){
        listado += "<li>"+usuariosExperimento[i]+" <button type='button' class='botonesMenu2' onClick='eliminarUsuario("+i+")'><i class='fas fa-minus-circle'></i>liminar usuario</button></li>";
    }

    document.getElementById("participantes").innerHTML = listado;

}

function irAPagina(pagina, id){
    window.location.assign(pagina+"?id="+id);
}

function validarProyecto(){
    var np = document.getElementById("nombreProyecto").value;
    var dp = document.getElementById("descripcionProyecto").value;
    var inf = document.getElementById("info").value;
    var huerto = document.getElementById("huerto").value;
    var a = document.getElementById("anio").value;
    var m = document.getElementById("mes").value;
    var d = document.getElementById("dia").value;
    var resp = document.getElementById("responsable").value;
    var colab = document.getElementById("colaboradores").value;
    
    if (np == "" || dp == "" || inf == "" || a == "" || m == "" || d == "" || resp == "" || huerto == ""| colab == ""){
        alert("LLene todos los campos para continuar");
    }else{
        if (d >=1 && d <= 31 && m >=1 && m <= 12 && a >= 2010 && a <= 2200){
            document.getElementById("f1").submit();
        }else{
            alert("la fecha es incorrecta");
        }
    }
}

function datosProyecto(id){
    window.location.assign("datosProyecto?id="+id);
}

function datosLResponsables(id){
    window.location.assign("datosLResponsables?id="+id);
}

function mostrarFecha(){
    var yy = document.getElementById("anio").value*1;
    var mm = document.getElementById("mes").value*1;
    var dd = document.getElementById("dia").value*1;
    var fecha ="";  //yyyy-mm-dd
    if (yy != ""){
        fecha += yy + "-";
    }

    if (mm != "" && mm < 10){
        fecha += "0" + mm + "-";
    }else{
        fecha += mm + "-";
    }

    if (dd != "" && dd < 10){
        fecha += "0" + dd;
    }else{
        fecha += dd;
    }

    //colocamos la fecha en la página
    document.getElementById("fecha").innerHTML = fecha;

    //validamos la fecha
    if (dd >=1 && dd <= 31 && mm >=1 && mm <= 12 && yy >= 2010 && yy <= 2200){
        document.getElementById("checkFecha").innerHTML = '<i class="fas fa-check-circle"></i>';
        document.getElementById("checkFecha").classList.remove("fechaWrong");
        document.getElementById("checkFecha").classList.add("fechaOK");
    }else{
        document.getElementById("checkFecha").innerHTML = '<i class="fas fa-times-circle"></i>';
        document.getElementById("checkFecha").classList.remove("fechaOK");
        document.getElementById("checkFecha").classList.add("fechaWrong");

    }
    
}


function subirFotoProyecto(id){
    window.location.assign("subirFotoProyecto.php?id="+id);
}
function validarFoto(){
    var foto = document.getElementById("c1").value;

    if(foto == ""){
        alert("Seleccione una foto para poder enviar el formulario");
    }else{
        document.getElementById("f1").submit();
    }

}

function cancelar(){
    //redeireccionamos al index.
    window.location.assign("moduloInicio.php");
}

function habilitarBotonYCampo(){
    document.getElementById("foto").classList.remove("botonEditarFotoDisabled");
    document.getElementById("foto").classList.add("botonEditarFoto");
    document.getElementById("foto").disabled = false;
   
}

function alertaBorrarFoto(){
    var r = confirm("Desea realmente borrar esta foto?");
    if (r){
        //deshabilitamos el campo FILE y el de ingreso de texto alternativo para la foto
        document.getElementById("foto").disabled = true;
       
        //cambiamos la hoja de estilo del boton
        document.getElementById("foto").classList.remove("botonEditarFoto");
        document.getElementById("foto").classList.add("botonEditarFotoDisabled");

    }else{
        // el usuario cancela la acción. Hay que volver a checar el botón NO
        document.getElementById("borrarFotoNo").checked = true;
    }
}

function regresarAIndex(){
    //redirecciona a la página index
    window.location.assign("moduloProyectos.php");
}

function editarProyecto(id){
    //Redireccionamos a la una página para editar los datos de la planta
    window.location.assign("editarProyecto.php?id="+id);
}

function logout(){
    window.location.assign("admin.php");
}

function cualMenu(cualMenu){
    if (cualMenu == 1){
        window.location.assign("moduloInicio.php");
    }else if (cualMenu == 2){
        window.location.assign("moduloInicio.php");
    }else if(cualMenu == 3){
        window.location.assign("moduloInicio.php");
    }
}

//Scripts para la caja modal
// Get the modal
var modal = document.getElementById("miModal");

// Get the button that opens the modal
var btn = document.getElementById("botonModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cerrarModal")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//Carrusel de imagenes

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block"; 
    dots[slideIndex-1].className += " active";
}



function internaProyectos(id){
    window.location.assign("internaProyectos?id="+id);
  }