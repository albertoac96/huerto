@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('content')

    @include("sitio.tutorial.cursos", ['data.capacitaciones' => 'capacitaciones'])
    @include("sitio.tutorial.verTutoriales", ['data.capacitaciones' => 'capacitaciones'])


@endsection