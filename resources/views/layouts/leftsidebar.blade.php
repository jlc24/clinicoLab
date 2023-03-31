<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Panel de Control
                        </p>
                    </a>
                </li>
                @php
                    $activeRoutesAdmin = [ 'cliente','usuario','medico' ];
                @endphp
                <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesAdmin) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesAdmin) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Administración
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item px-4">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fa-solid fa-user-plus"></i>
                                <p>Usuarios del Sistema</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('cliente') }}" class="nav-link {{ Request::is('clientes') ? 'active' : '' }}">
                                <i class=" nav-icon fa-solid fa-user"></i>
                                <p>Pacientes</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('medico') }}" class="nav-link {{ Request::is('medicos') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-user-doctor"></i>
                                <p>Medicos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $activeRoutesCatalog = [ 'antibiograma', 'bacteria', 'cultivo', 'estudio', 'medicamento', 'laboratorio', 'muestra', 'indication', 'recipiente'];
                @endphp
                <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesCatalog) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesCatalog) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-medical"></i>
                        <p>
                            Catalogos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" >
                        <li class="nav-item px-4" hidden>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-microscope"></i>
                                <p>Antibiogramas</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('bacteria') }}" class="nav-link {{ Request::is('bacterias') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-bacteria"></i>
                                <p>Bacterias</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('cultivo') }}" class="nav-link {{ Request::is('cultivos') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-vial"></i>
                                <p>Cultivos</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('estudio') }}" class="nav-link {{ Request::is('estudios') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>Estudios</p>
                            </a>
                        </li>
                        <li class="nav-item px-4" hidden>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-capsules"></i>
                                <p>Medicamentos</p>
                            </a>
                        </li>
                        <li class="nav-item px-4" hidden>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clinic-medical"></i>
                                <p>Laboratorio</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('muestra') }}" class="nav-link {{ Request::is('muestras') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-prescription-bottle"></i>
                                <p>Tipos de Muestras</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('indication') }}" class="nav-link {{ Request::is('indications') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>Indicaciones</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="{{ route('recipiente') }}" class="nav-link {{ Request::is('recipientes') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                                <p>Recipientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $activeRoutesCaptura = [ 'recepcion' ];
                @endphp
                <li class="nav-item {{ in_array(Route::currentRouteName(), $activeRoutesCaptura) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $activeRoutesCaptura) ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-square-poll-vertical"></i>
                        <p>
                            Capturas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item px-4">
                            <a href="{{ route('recepcion') }}" class="nav-link {{ Request::is('recepcion') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-keyboard"></i>
                                <p>Recepción</p>
                            </a>
                        </li>
                        <li class="nav-item px-4">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fas fa-poll-h"></i>
                                <p>Resultados</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $activeRoutesTools = [ ];
                @endphp
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
                        <p>
                            Herramientas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fa-solid fa-user-plus"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-doctor"></i>
                                <p>Medicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-cart-plus nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $activeRoutesPrint = [ ];
                @endphp
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-print"></i>
                        <p>
                            Reimpresiones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fa-solid fa-user-plus"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-doctor"></i>
                                <p>Medicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-cart-plus nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $activeRoutesReport = [ ];
                @endphp
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-file-lines"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class=" nav-icon fa-solid fa-user-plus"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-user-doctor"></i>
                                <p>Medicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-cart-plus nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>