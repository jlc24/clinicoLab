@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Catálogo') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Catálogo') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Estudio') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-sm-10">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_estudio" title="Agregar estudio" class="btnAddEstudio">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Estudios') }}
                            </h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-xl-8 col-sm-8">
                                    <h4>{{ __('Estudios o Análisis registrados en el Sistema') }}</h4>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="search_estudio">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="search_estudio" id="search_estudio">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <table class="table table-sm table-bordered table-hover tabla_estudios" id="tabla_estudios">
                                        <thead style="background-color: #BAECCA">
                                            <th class="text-right" style="border: 1px solid #C6C8CA;">#</th>
                                            <th style="border: 1px solid #C6C8CA;">{{ __('Clave') }}</th>
                                            <th style="border: 1px solid #C6C8CA;">{{ __('Nombre') }}</th>
                                            <th hidden style="border: 1px solid #C6C8CA;">{{ __('Precio') }}</th>
                                            <th class="text-center" style="border: 1px solid #C6C8CA;">{{ __('Estado') }}</th>
                                            <th class="text-center" style="border: 1px solid #C6C8CA;">Op</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
    @include('estudio.modal.modal_crear_estudio')
    @include('estudio.modal.modal_modificar_estudio')
    @include('estudio.modal.modal_config_estudio_individual')
    @include('procedimiento.modal.modal_crear_procedimiento')
    @include('componente.modal.modal_crear_componente')
    @include('aspecto.modal.modal_crear_aspecto')
    @include('estudio.modal.modal_config_parametro')
    @include('estudio.modal.modal_agregar_material')
    @include('estudio.modal.modal_crear_grupo')
    @include('estudio.modal.modal_crear_subgrupo')
    @include('muestra.modal.modal_crear_muestra')
@endsection

@section('funciones')
    @include('estudio.funciones.funciones_estudio')
@endsection