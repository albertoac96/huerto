@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.actividad.verActividades",['data.actividades' => 'actividades'])
  
   
   

@endsection