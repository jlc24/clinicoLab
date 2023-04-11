<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')

</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <!-- Top bar -->
        @include('layouts.topbar')
        <!-- /.navbar Left Sidebar -->
        @guest
        @else
            @include('layouts.leftsidebar')
        @endguest
        
          <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('contenido')

        </div>
          <!-- /.content-wrapper -->
        @guest
            @else
            @include('layouts.footer')
        @endguest
    </div>
    
    @include('layouts.librerias')
    
    @include('layouts.funciones')
    
    @yield('funciones')

</body>
</html>