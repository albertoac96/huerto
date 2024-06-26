@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')
       
    @include("sitio.acercade.espacios")
    @include("sitio.acercade.tecnologia")
    @include("sitio.acercade.ofrece")
    
  
    @include("sitio.acercade.colaboradores",['data.colaboradores' => 'colaboradores'])
  
   
   

@endsection