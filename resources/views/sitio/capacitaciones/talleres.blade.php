@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.catalogo.infografia")  
    @include("sitio.capacitaciones.talleres",['data.plantas' => 'plantas'])
  
   
   

@endsection