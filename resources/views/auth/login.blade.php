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
        <link rel="stylesheet" href="../styles/admin/estilosIngreso.css">
</head>
<body>
<header>
    <h1>HUERTO IBERO</h1>
    <figure>
            <img src="../images/fondo/tabletlogologind.png" alt="dcas.">
        </figure>
    <p>Bienvenido/a al administrador del Huerto IBERO</p>
</header>
    <section>
        <h2>Título del formulario</h2>
            <form class="formulario" method="post" action="login_xt.php">
                <fieldset>
                <legend>Ingresa tus datos</legend>
               <label for="nombre">Nombre:</label>
               <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <br>
                    <br>
                <label for="password">Contraseña:</label>
                 <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                             <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                </fieldset>
                <br>
                <br>
                            
                        <br>
                       <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
             
            </form>
    </section>
</body>
</html>