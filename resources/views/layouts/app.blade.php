<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Top bar -->
        @include('layouts.topbar')
        <!-- /.navbar Left Sidebar -->
        @include('layouts.leftsidebar')
          <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #E5E6E7">

            @yield('contenido')

        </div>
          <!-- /.content-wrapper -->
        @include('layouts.footer')
        
    </div>
    <div id="loader-wrapper">
        <div class="contenedor">
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>
            <span class="loading">Cargando...</span>
        </div>
    </div>
    
    <div id="wpcp-error-message" class="msgmsg-box-wpcp hideme"><span>error: </span></div>
    @include('layouts.librerias')
    
    @include('layouts.funciones')
    
    @yield('funciones')

</body>
</html>