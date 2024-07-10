@extends('sitio.main.sitio', ['$sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.capacitaciones.cursos", ['$capacitaciones' => 'capacitaciones'])  

    @include("sitio.capacitaciones.tutoriales",['$tutoriales' => 'tutoriales'])


  
@endsection



@section('estilos')
<style>
.pagination {
    justify-content: center; /* Centra la paginación */
}

.page-item.disabled .page-link {
    color: red; /* Color de texto para elementos deshabilitados */
}

.page-link {
    color: #007bff; /* Color de texto de los enlaces */
    background-color: #fff; /* Color de fondo */
    border: 1px solid #dee2e6; /* Borde */
}

.page-link:hover {
    color: #0056b3;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

.page-item.active .page-link {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
</style>

@endsection