<nav class="navbar navbar-expand-lg bg-body-tertiary" >
  <div class="container-fluid">
  <a class="navbar-brand" href="{{route('admin.inicio')}}">
   
      <img src="/images/logos/icono_huerto-ibero_desktop.svg" alt="Huerto" width="150" height="89">
    
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Información
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('actividades')}}"">Actividades</a></li>
            <li><a class="dropdown-item" href="{{route('capacitaciones')}}">Capacitaciones</a></li>
            <li><a class="dropdown-item" href="{{route('noticias')}}">Noticias</a></li>
            <li><a class="dropdown-item" href="{{route('eventos')}}">Eventos</a></li>
            <!--<li><a class="dropdown-item" href="{{route('bios')}}">Biografias</a></li>-->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestión
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('huertos')}}">Huertos</a></li>
            <li><a class="dropdown-item" href="{{route('proyectos')}}">Proyectos</a></li>
            <li><a class="dropdown-item" href="{{route('experimentos')}}">Experimentos</a></li>
            <li><a class="dropdown-item" href="{{route('plantas')}}">Plantas</a></li>
            <li><a class="dropdown-item" href="{{route('semillas')}}">Semillas</a></li>
            <li><a class="dropdown-item" href="{{route('contenedores')}}">Contenedores</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown" id="AdminUsuarios">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Configuración
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('usuarios')}}">Usuarios</a></li>
       
            <li><a class="dropdown-item" href="https://www.google.com/u/3/recaptcha/admin/site/691049981" target="_blank">Google reCAPTCHA</a></li>
        
            <li><a class="dropdown-item" href="https://analytics.google.com/analytics/web/provision/?authuser=3#/p449574324/reports/intelligenthome" target="_blank">Google Analytics</a></li>
      
            <li><a class="dropdown-item" href="https://search.google.com/u/3/search-console/welcome" target="_blank">Google Search Console</a></li>
          </ul>
          
        </li>



      </ul>


      <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="/password/reset">Cambiar contraseña</a>
                                </div>
                            </li>
                        @endguest

                        
                    </ul>


    </div>

   

  </div>
</nav>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('traeRol') }}')
            .then(response => response.json())
            .then(data => {
                 if (data === 1) {
                        document.getElementById('AdminUsuarios').style.display = 'block';
                    } else {
                        document.getElementById('AdminUsuarios').style.display = 'none';
                    }
            });
    });
</script>