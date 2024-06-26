@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')

@include("sitio.proyecto.catalogoProyectos", ['data.proyectos' => 'proyectos'])


@endsection