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
                        <li class="breadcrumb-item active">{{ __('Indicaciones') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-sm-8">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_indicacion" title="Agregar indicacion">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Indicaciones') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <h3>{{ __('Indicaciones registrados en el Sistema') }}</h3><hr>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="search_indicaciones">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="search_indicaciones" id="search_indicaciones">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_indicaciones" id="tabla_indicaciones">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Descripcion') }}</th>
                                        <th class="text-center">{{ __('Op') }}</th>
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
    </section>
        
    @include('indication.modal.modal_crear_indications')
    @include('indication.modal.modal_actualizar_indications')
@endsection

@section('funciones')
    @include('indication.funciones.funcion_indicacion')
@endsection