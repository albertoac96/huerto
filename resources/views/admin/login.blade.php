<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Alhondra Isabel Vázquez, Ivon Mondragon R., Luis Enrique Gutierrez P.">
    <title>Administrador Huerto-Ibero</title>
    <meta name="title" content="Huerto Ibero">
    <meta name="description" content="Página administrativa del HUERTO IBERO José de Acosta, S.J.. Quien sabe lo que siembra, no le teme a lo que cosecha. Juntos, en comunidad. Ibero.">
    <meta name="keywords" content="Huerto Ibero, Universidad Iberoamericana, Nombre, Contraseña, Administrador Huerto Ibero, Hueto Ibero login Administrador">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Spanish">
    <meta name="viewport" content="width=devicee-width, initial-scale=1">
    <meta compatibilidad IE=edge>

     

     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="../styles/admin/estilosIngreso.css">
    <link href="../styles/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../styles/bootstrap.bundle.js"></script>

      {!! htmlScriptTagJsApi(['lang' => 'es']) !!}
</head>
<body>
    <header>
        <h1>HUERTO IBERO</h1>
        <figure>
            <img src="{{asset('images/fondo/tabletlogologind.png')}}">
        </figure>
        <p>Bienvenido/a al administrador del Huerto IBERO</p>
    </header>
    <section>
        <h2>Título del formulario</h2>
        <form class="formulario" method="POST" action="{{ route('login') }}">
            @csrf
            <fieldset class="m-5 pt-3">
                <legend><label>Ingresa tus datos</label></legend>
                <label for="nombre">Correo:</label>
                <input id="email" type="email" class="form-control campo @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <br>
                <label for="password">Contraseña:</label>


                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror



                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                 <div class="col-12 m-4">



               

                <div class="col-12">
                    <!-- Google Recaptcha -->
                {!! htmlFormSnippet() !!}

                 @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        {{ __('Login') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>



            </fieldset>

           

        </form>
    </section>
</body>
</html>
