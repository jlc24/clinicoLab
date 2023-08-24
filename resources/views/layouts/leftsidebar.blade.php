<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @if(Auth::user()->rol === 'cliente')
        <a href="{{ route('paciente') }}" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>
    @else
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
        </a>
    @endif
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->rol =='admin' || Auth::user()->rol =='usuario')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                            {{ __('Panel de Control') }}
                            </p>
                        </a>
                    </li>
                    @php
                        $activeRoutesAdmin = [ 'cliente','usuario','medico','empresa', 'usuario', 'permiso'];
                    @endphp
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesAdmin) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesAdmin) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                {{ __('Administración') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Auth::user()->rol =='admin')
                                <li class="nav-item px-2">
                                    <a href="{{ route('usuario') }}" class="nav-link {{ Request::is('usuarios') ? 'active' : '' }}">
                                        <i class=" nav-icon fa-solid fa-user-plus"></i>
                                        <p>{{ __('Usuarios del Sistema') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('permiso') }}" class="nav-link {{ Request::is('permisos') ? 'active' : '' }}">
                                        <i class=" nav-icon fa-solid fa-cogs"></i>
                                        <p>{{ __('Permisos') }}</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item px-2">
                                <a href="{{ route('cliente') }}" class="nav-link {{ Request::is('clientes') ? 'active' : '' }}">
                                    <i class=" nav-icon fa-solid fa-user"></i>
                                    <p>{{ __('Pacientes') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="{{ route('medico') }}" class="nav-link {{ Request::is('medicos') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-user-doctor"></i>
                                    <p>{{ __('Medicos') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="{{ route('empresa') }}" class="nav-link {{ Request::is('empresas') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>{{ __('Empresas') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'medico')
                        @php
                            $activeRoutesCatalog = [ 
                                'antibiograma', 
                                'bacteria', 
                                'cultivo', 
                                'estudio', 
                                'medicamento', 
                                'laboratorio', 
                                'muestra', 
                                'indication', 
                                'recipiente', 
                                'metodologia', 
                                'umedida', 
                                'categoria', 
                                'material',
                                'provider'
                            ];
                        @endphp
                        <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesCatalog) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesCatalog) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book-medical"></i>
                                <p>
                                    {{ __('Catálogos') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" >
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-microscope"></i>
                                        <p>{{ __('Antibiogramas') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="{{ route('bacteria') }}" class="nav-link {{ Request::is('bacterias') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-bacteria"></i>
                                        <p>{{ __('Bacterias') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="{{ route('cultivo') }}" class="nav-link {{ Request::is('cultivos') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-vial"></i>
                                        <p>{{ __('Cultivos') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('estudio') }}" class="nav-link {{ Request::is('estudios') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>{{ __('Estudios') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-capsules"></i>
                                        <p>{{ __('Medicamentos') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-clinic-medical"></i>
                                        <p>{{ __('Laboratorio') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('muestra') }}" class="nav-link {{ Request::is('muestras') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-prescription-bottle"></i>
                                        <p>{{ __('Muestras') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('indication') }}" class="nav-link {{ Request::is('indications') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-file-contract"></i>
                                        <p>{{ __('Indicaciones') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('recipiente') }}" class="nav-link {{ Request::is('recipientes') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                                        <p>{{ __('Recipientes') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('metodologia') }}" class="nav-link {{ Request::is('metodologias') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-procedures"></i>
                                        <p>{{ __('Metodologías') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('umedida') }}" class="nav-link {{ Request::is('umedidas') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-ruler-horizontal"></i>
                                        <p>{{ __('Unidades de Medida') }}</p>
                                    </a>
                                </li>
                                @if(Auth::user()->rol =='admin')
                                    <li class="nav-item px-2">
                                        <a href="{{ route('categoria') }}" class="nav-link {{ Request::is('categorias') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-folder"></i>
                                            <p>{{ __('Categoría') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item px-2">
                                        <a href="{{ route('material') }}" class="nav-link {{ Request::is('materials') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-toolbox"></i>
                                            <p>{{ __('Materiales') }}</p>
                                        </a>
                                    </li>
                                    <li class="nav-item px-2">
                                        <a href="{{ route('provider') }}" class="nav-link {{ Request::is('providers') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-users-rectangle"></i>
                                            <p>{{ __('Proveedores') }}</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @php
                        $activeRoutesCaptura = [ 'recepcion', 'historyViewRecepcion', 'resultado.prueba', 'resultado.estudio', 'resultado.paciente'  ];
                    @endphp
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesCaptura) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesCaptura) ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-square-poll-vertical"></i>
                            <p>
                                {{ __('Capturas') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item px-2">
                                <a href="{{ route('recepcion') }}" class="nav-link {{ Request::is('recepcion') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-keyboard"></i>
                                    <p>{{ __('Recepción') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="{{ route('historyViewRecepcion') }}" class="nav-link {{ Request::is('historyView') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-clipboard"></i>
                                    <p>{{ __('Historial Recepción') }}</p>
                                </a>
                            </li>
                            @if(Auth::user()->rol =='admin')
                                <li class="nav-item px-2">
                                    <a href="{{ route('resultado.prueba') }}" class="nav-link {{ Request::is('resultados/pruebas') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fas fa-poll-h"></i>
                                        <p>{{ __('Resultados por Pruebas') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2">
                                    <a href="{{ route('resultado.estudio') }}" class="nav-link {{ Request::is('resultados/estudios') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fas fa-poll-h"></i>
                                        <p>{{ __('Resultados por Estudio') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="{{ route('resultado.paciente') }}" class="nav-link {{ Request::is('resultados/pacientes') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fas fa-poll-h"></i>
                                        <p>{{ __('Resultados por Paciente') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @php
                        $activeRoutesTools = [ 'caja' ];
                    @endphp
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesTools) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesTools) ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
                            <p>
                                {{ __('Herramientas') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item px-2">
                                <a href="{{ route('caja') }}" class="nav-link {{ Request::is('cajas') ? 'active' : '' }}">
                                    <i class=" nav-icon fas fa-box"></i>
                                    <p>{{ __('Cajas') }}</p>
                                </a>
                            </li>
                            @if(Auth::user()->rol == 'admin')
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class=" nav-icon fas fa-file-archive"></i>
                                        <p>{{ __('Facturas') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa-solid fa-user-doctor"></i>
                                        <p>{{ __('Corte de Caja') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-square-root-alt nav-icon"></i>
                                        <p>{{ __('Fórmulas') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-clipboard nav-icon"></i>
                                        <p>{{ __('Lista de Precios') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="fa-solid fa-cart-plus nav-icon"></i>
                                        <p>{{ __('Control de Resultados') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item px-2" hidden>
                                    <a href="#" class="nav-link">
                                        <i class="fa-solid fa-cart-plus nav-icon"></i>
                                        <p>{{ __('Convenios') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @php
                        $activeRoutesPrint = [ 'factura', 'resultado'];
                    @endphp
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesPrint) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesPrint) ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-print"></i>
                            <p>
                                {{ __('Reimpresiones') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item px-2">
                                <a href="{{ route('factura') }}" class="nav-link {{ Request::is('facturas') ? 'active' : '' }}">
                                    <i class=" nav-icon fas fa-file-archive"></i>
                                    <p>{{ __('Facturas') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="{{ route('resultado') }}" class="nav-link {{ Request::is('resultados') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>{{ __('Resultados') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @php
                        $activeRoutesReport = [ 'reporte.caja', 'reporte.estudio', 'reporte.material', 'reporte.economico' ];
                    @endphp
                    <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesReport) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesReport) ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-file-lines"></i>
                            <p>
                                {{ __('Reportes') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item px-2">
                                <a href="{{ route('reporte.caja') }}" class="nav-link {{ Request::is('reportes/cajas') ? 'active' : '' }}">
                                    <i class=" nav-icon ">C</i>
                                    <p>{{ __('ajas') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2" hidden>
                                <a href="{{ route('reporte.material') }}" class="nav-link {{ Request::is('reportes/materiales') ? 'active' : '' }}">
                                    <i class="nav-icon ">M</i>
                                    <p>{{ __('aterial') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2" hidden>
                                <a href="{{ route('reporte.economico') }}" class="nav-link {{ Request::is('reportes/economicos') ? 'active' : '' }}">
                                    <i class="nav-icon ">R</i>
                                    <p>{{ __('eporte Económico') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2">
                                <a href="{{ route('reporte.estudio') }}" class="nav-link {{ Request::is('reportes/estudios') ? 'active' : '' }}">
                                    <i class="nav-icon ">E</i>
                                    <p>{{ __('studios') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2" hidden>
                                <a href="#" class="nav-link">
                                    <i class="nav-icon ">G</i>
                                    <p>{{ __('enerales') }}</p>
                                </a>
                            </li>
                            <li class="nav-item px-2" hidden>
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>{{ __('Lista de reportes') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                @else
                    <li class="nav-item">
                        <a href="{{ route('paciente') }}" class="nav-link {{ Route::currentRouteName() === 'paciente' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>
                            {{ __('Resultados') }}
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>