@extends('sitio.main.sitio', ['$sitiosrel' => 'sitiosrel'])

@section('content')

@include("sitio.proyecto.catalogoProyectos", ['$proyectos' => 'proyectos'])


@endsection