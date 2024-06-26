@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.catalogo.infografia",['data' => 'data'])
  
   @include("sitio.catalogo.paleta",['data.plantas' => 'plantas'])



   
   

@endsection

