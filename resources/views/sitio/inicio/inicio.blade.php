@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')

    
    @include("sitio.inicio.proposito")
    @include("sitio.inicio.biografia", ['data.biografia' => 'biografia'])
    @include("sitio.inicio.proyecto", ['data.proyectos' => 'proyectos'])
    @include("sitio.inicio.eventos", ['data.eventos' => 'eventos'])
    @include("sitio.inicio.noticias",['data.noticias' => 'noticias'])
   
   

@endsection