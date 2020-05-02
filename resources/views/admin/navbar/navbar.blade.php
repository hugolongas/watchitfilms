<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{'/'}}" style="color:#777">
            <img class="brand-logo" src="{{ asset('img/logo.png') }}" alt="Logo" style="width:150px;" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::is('admin.article.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.article.index')}}">GESTIÓN ARTICULOS</a>
                </li>
                <li class="nav-item {{ Route::is('admin.categories.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">GESTIÓN CATEGORIAS</a>
                </li>
                <li class="nav-item {{ Route::is('admin.clientes.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.clientes.index')}}">GESTIÓN CLIENTES</a>
                </li>
                <li class="nav-item {{ Route::is('admin.cargos.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.cargos.index')}}">GESTIÓN CARGOS</a>
                </li>
                <li class="nav-item {{ Route::is('admin.miembros.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('admin.miembros.index')}}">GESTIÓN MIEMBROS</a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>