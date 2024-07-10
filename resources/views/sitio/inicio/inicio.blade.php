@extends('sitio.main.sitio', ['data.sitiosrel' => 'sitiosrel'])

@section('meta')
    <!-- Tarjetas de Facebook -->
    <meta property="og:title" content="{{ $metaTags['title'] }}">
    <meta property="og:description" content="{{ $metaTags['description'] }}">
    <meta property="og:url" content="{{ $metaTags['url'] }}">
    <meta property="og:image" content="{{ $metaTags['image'] }}">
    <meta property="og:image:alt" content="{{ $metaTags['image_alt'] }}">
    <!-- Tarjetas de Twitter -->
    <meta name="twitter:title" content="{{ $metaTags['title'] }}">
    <meta name="twitter:description" content="{{ $metaTags['description'] }}">
    <meta name="twitter:url" content="{{ $metaTags['url'] }}">
    <meta name="twitter:image" content="{{ $metaTags['image'] }}">
    <meta name="twitter:image:alt" content="{{ $metaTags['image_alt'] }}">
    <!-- Metaetiquetas adicionales para SEO -->
    <meta name="description" content="{{ $metaTags['description'] }}">

@endsection

@section('content')

    
    @include("sitio.inicio.proposito")
    @include("sitio.inicio.biografia", ['data.biografia' => 'biografia'])
    @include("sitio.inicio.proyecto", ['data.proyectos' => 'proyectos'])
    @include("sitio.inicio.eventos", ['data.eventos' => 'eventos'])
    @include("sitio.inicio.noticias",['data.noticias' => 'noticias'])
   
   

@endsection