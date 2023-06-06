
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
                    @if(Auth::user()->rol == 'cliente')
                        {{ Auth::user()->cliente->cli_nombre }} {{ Auth::user()->cliente->cli_apellido_pat }} {{ Auth::user()->cliente->cli_apellido_mat }} ({{ Auth::user()->rol }})
                    @elseif(Auth::user()->rol == 'usuario')
                        {{ Auth::user()->usuario->usuario_nombre }} {{ Auth::user()->usuario->usuario_apellido_pat }} {{ Auth::user()->usuario->usuario_apellido_mat }} ({{ Auth::user()->rol }})
                    @elseif(Auth::user()->rol == 'medico')
                        {{ Auth::user()->medico->med_nombre }} {{ Auth::user()->medico->med_apellido_pat }} {{ Auth::user()->medico->med_apellido_mat }} ({{ Auth::user()->rol }})
                    @elseif(Auth::user()->rol == 'admin')
                        {{ Auth::user()->user }}
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->rol == 'cliente')
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();"> 
                        {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @elseif(Auth::user()->rol == 'medico' || Auth::user()->rol == 'usuario' || Auth::user()->rol == 'admin')
                        <a class="dropdown-item" href="{{ route('perfil') }}">
                            {{ __('Perfil') }}
                        </a>
                        @if(Auth::user()->rol == 'admin')
                            <a class="dropdown-item" href="{{ route('configuration') }}">
                                {{ __('Configuración') }}
                            </a>
                        @endif
                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            $.ajax({
                                url: '{{ route('getCajaStatus') }}',
                                type: 'GET',
                                success: function(data) {
                                    if (data.caja_estado == 1) {
                                        Swal.fire({
                                            title: 'Caja Abierta',
                                            text: 'Aun tiene caja abierta, debe cerrarla para cerrar sesion',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 3000,
                                        }).then(function() {
                                            window.location.href = '{{ route('caja') }}';
                                        });
                                    }else{
                                        $('#logout-form').submit();
                                    }
                                }
                            });">
                            {{ __('Cerrar Sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </div>
            </li>
        </ul>
    </nav>
@endguest
