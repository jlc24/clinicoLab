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
                    <li class="breadcrumb-item active">{{ __('Economico') }}</li>
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
                            {{ __('Reporte Economicos') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-xl-1 col-sm-12">
                                <label for="filtrar_mes" class="form-label col-md-12">{{ __('Dia') }}</label>
                            </div>
                            <div class="col-xl-2 col-sm-4">
                                <div class="form-group row">
                                    <div class="col-md-12" style="display: inline-flex">
                                        <select id="filtrar_mes" class="custom-select custom-select-sm" name="filtrar_mes">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-1 col-sm-12">
                                <label for="filtrar_mes" class="form-label col-md-12">{{ __('Mes') }}</label>
                            </div>
                            <div class="col-xl-2 col-sm-4">
                                <div class="form-group row">
                                    <div class="col-md-12" style="display: inline-flex">
                                        <select id="filtrar_mes" class="custom-select custom-select-sm" name="filtrar_mes">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-1 col-sm-12">
                                <label for="filtrar_anio" class="form-label col-md-12">{{ __('Año') }}</label>
                            </div>
                            <div class="col-xl-2 col-sm-4">
                                <div class="form-group row">
                                    <div class="col-md-12" style="display: inline-flex">
                                        <select id="filtrar_anio" class="custom-select custom-select-sm" name="filtrar_anio">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12 text-right">
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
                                            <th>{{ __('Nombre') }}</th>
                                            <th>{{ __('Descripcion') }}</th>
                                            <th>{{ __('Categoria') }}</th>
                                            <th>{{ __('Estado') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
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