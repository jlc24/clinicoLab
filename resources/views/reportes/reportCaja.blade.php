@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Reportes') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Reportes') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Cajas') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                {{ __('Reporte Cajas') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-sm-12">
                                    <div class="btn-group" role="group" aria-label="Button group">
                                        <button class="btn btn-outline-danger btn-sm" title="Exportar a PDF"><i class="fas fa-file-pdf fa-2x"></i></button>
                                        <button class="btn btn-outline-warning btn-sm" title="Exportar a CSV"><i class="fas fa-file-csv fa-2x"></i></button>
                                        <button class="btn btn-outline-success btn-sm" title="Exportar a Excel"><i class="fas fa-file-excel fa-2x"></i></button>
                                        <button class="btn btn-outline-primary btn-sm" title="Exportar a Word"><i class="fas fa-file-word fa-2x"></i></button>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row justify-content-center">
                                <div class="col-xl-11 col-sm 12">
                                    <table class="table table-bordered table-sm table-hover table-responsive-sm tabla_materiales" id="tabla_materiales">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('Usuario') }}</th>
                                                <th>{{ __('Fecha') }}</th>
                                                <th>{{ __('total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cajas as $caja)
                                                <tr>
                                                    <td>Caja {{ $caja->id }}</td>
                                                    <td>{{ $caja->user->usuario->usuario_nombre }}</td>
                                                    <td>{{ $caja->updated_at }}</td>
                                                    <td class="text-right">{{ $caja->caja_monto_final }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection