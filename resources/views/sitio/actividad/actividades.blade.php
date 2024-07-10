@extends('sitio.main.sitio', ['$sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.actividad.verActividades",['$actividades' => 'actividades'])
  
   
   

@endsection