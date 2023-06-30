<nav class="main-header navbar navbar-expand" style="background-color: #4B6978; color: #fff">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #fff;"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'usuario')
            <li class="nav-item dropdown" hidden>
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell fa-2x" style="color: #fff"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
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

