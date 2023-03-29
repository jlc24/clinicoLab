
@guest
<nav class="navbar navbar-white p-2">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="navbar-brand"><strong>{{ config('app.name', 'Laravel') }}</strong></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">Sistema</a>
            </li>
        @else
            @if (Route::has('login'))
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                </li>
            @elseif (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Registrar</a>
                </li>
            @endif
        @endauth
    </ul>
</nav>
@else
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->user }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('perfil') }}">
                        {{ __('Perfil') }}
                    </a><hr>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
@endguest
