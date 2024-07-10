@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
   

     
   @include("sitio.catalogo.leaflet",['data.contenedores' => 'contenedores', 'data.mapa' => 'mapa'])

   @include("sitio.catalogo.paleta",['data.plantas' => 'plantas'])



   
   

@endsection






