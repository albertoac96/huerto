<nav class="navbar navbar-expand-md bg-transparent fixedInicio" style="background-color: #2C4625;" data-bs-theme="dark">
  <div class="container h-100">
    <a class="navbar-brand" href="{{ route('inicio') }}">
      <img src="../images/logos/icono_huerto-ibero_desktop.svg" alt="Bootstrap" width="300" height="200">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav" style="text-align:center;">
        <li class="nav-item ms-2">
          <a href="{{ route('inicio') }}" target="_self"><img src="../images/iconos_nav/inicio.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}" role="menuitem" href="{{ route('inicio') }}" target="_self">Inicio</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('acercaDe') }}" target="_self"><img src="../images/iconos_nav/acerca.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('acercaDe') ? 'active' : '' }}" role="menuitem" href="{{ route('acercaDe') }}" target="_self">Acerca De</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('showCatalogo') }}" target="_self"><img src="../images/iconos_nav/catalogo.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('showCatalogo') ? 'active' : '' }}" role="menuitem" href="{{ route('showCatalogo') }}" target="_self">Catálogo</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('showProyectos') }}" target="_self"><img src="../images/iconos_nav/proyectos.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('showProyectos') ? 'active' : '' }}" role="menuitem" href="{{ route('showProyectos') }}" target="_self">Proyectos</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('showActividades') }}" target="_self"><img src="../images/iconos_nav/act.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('showActividades') ? 'active' : '' }}" role="menuitem" href="{{ route('showActividades') }}" target="_self">Actividades</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('showCapacitacion') }}" target="_self"><img src="../images/iconos_nav/capacitacion.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('showCapacitacion') ? 'active' : '' }}" role="menuitem" href="{{ route('showCapacitacion') }}" target="_self">Capacitación</a>
        </li>
        <li class="nav-item ms-3">
          <a href="{{ route('showContactos') }}" target="_self"><img src="../images/iconos_nav/contacto.svg" width="50vh"></a>
          <a class="nav-link {{ request()->routeIs('showContactos') ? 'active' : '' }}" role="menuitem" href="{{ route('showContactos') }}" target="_self">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>





<style>
  .nav-link:hover {
    /*Modifica lo que quieras*/

    color: black;
    margin: 0%;
    /*background: url(../images/hover_nav.svg)bottom -1% center/ 90% no-repeat;*/
    background-color: #F2F6ED;
    border-bottom-left-radius: 1em;
    border-top-right-radius: 1em;
  }

  .nav-link.active {
    /*Modifica lo que quieras*/

    color: black !important;;
    margin: 0%;
    /*background: url(../images/hover_nav.svg)bottom -1% center/ 90% no-repeat;*/
    background-color: #F2F6ED;
    border-bottom-left-radius: 1em;
    border-top-right-radius: 1em;
}

 
</style>