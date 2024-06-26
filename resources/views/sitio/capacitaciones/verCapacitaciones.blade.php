@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.capacitaciones.cursos", ['data.capacitaciones' => 'capacitaciones'])  
    @include("sitio.capacitaciones.tutoriales",['data.tutoriales' => 'tutoriales'])
  
@endsection