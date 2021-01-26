<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/home">Distribuidora Hermanos Diaz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                @else
                    <li class="nav-item active">
                        <a class="nav-link" href="/home">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Empleados
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="/home/employees">Empleados</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/home/userfacts">Usuarios</a>
                     </div>
                   </li>
                    <li class="nav-item">
                       <a class="nav-link" href="/home/clients">Clientes</a>
                   </li>
                   <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Producto
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="/home/categories">Categoria</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/home/products">Productos</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/home/existproducts">Productos Existentes</a>
                     </div>
                   </li>
                   <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Inventario
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <a class="dropdown-item" href="/home/providers">Proveedor</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/home/norders">Nueva Orden</a>
                       <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="/home/orders">Lista de Ordenes</a>
                     </div>
                   </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Facturas
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/home/dbills">Facturas del Dia</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/mbills">Facturas del Mes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/bills">Facturas</a>
                      </div>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Detalle Ventas
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/home/detalle/semanal">Semanal Actual</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detalle/semanaante">Semana Pasada</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detalle/semanaante_pasada">Semana Antepasada</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detalle/general">General</a>
                      </div>
                    </li>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Detalle Compras
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/home/detallec/semanal">Semanal Actual</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detallec/semanaante">Semana Pasada</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detallec/semanaante_pasada">Semana Antepasada</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/home/detallec/ordengeneral">General</a>
                      </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                             <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                          </svg>
                          {{ Auth::user()->username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Cerrar Sesion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>