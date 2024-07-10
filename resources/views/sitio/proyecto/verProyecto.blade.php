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


<div class="container-fluid secClara">
    <div class='container'>
        <h2 class='titulo'>{{$proyecto->cNombre}}</h2>
        <p><b>Fecha del proyecto: </b>{{$FechaCorta($proyecto->dInicio)}}</p>
        <h4 class='texttitle'>Descripción</h4>
        <label class='textcard m-3'>{{$proyecto->cDescripcion}}</label>

        <div class='row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 m-2 mt-4'>
            <div class='col-6'>
                <h4 class='texttitle'>Problemática</h4>
                <label class='textcard m-2'>{{$proyecto->cProblematica}}</label>
            </div>
            <div class='col-6'>
                <h4 class='texttitle'>Incidencia</h4>
                <label class='textcard m-2'>{{$proyecto->cIncidencia}}</label>
            </div>
        </div>

        <h4 class='texttitle mt-4'>Responsable</h4>

        <center><div class="col-3 mt-2">

            <div class="card bg-transparent" style="border:0">
                <div class="img-container">
                    <img src="{{asset('images/content/colaboradores').'/'.$proyecto->idUsuario.'.webp'}}" style="border:0;border-top-left-radius:3em;border-bottom-right-radius:3em;object-fit: cover;">
                </div>
                @if($proyecto->cLink)
                <div class="card-img-overlay">
                    <button class="botonPequeno position-absolute bottom-0 end-0" type="button"'
                            onclick="javascript:window.open(' {{ $proyecto->cLink }}', '_blank' );">¡Conoce más!
                    </button>
                </div>
                @endif
            </div>

            <div class="card-body">
                <label class='textcard'>{{$proyecto->nombre}} {{$proyecto->apellido}}</label><br>
                <label class="card-text">{{$proyecto->escolaridad}}</label><br>

                @if($proyecto->comunidadIbero)
                <label class="card-text">{{ $proyecto->comunidadIbero }}</label><br>
                @endif

                @if($proyecto->otraInstitucion)
                <label class="card-text">{{ $proyecto->otraInstitucion }}</label><br>
                @endif



            </div>
        </div></center>
    </div>
</div>

@endsection