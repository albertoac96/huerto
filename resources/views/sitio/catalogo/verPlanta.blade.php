@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')

@include("sitio.catalogo.moduloVerPlanta", ['data.planta' => 'planta'])


@endsection
