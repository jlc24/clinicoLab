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
                        <li class="breadcrumb-item active">{{ __('Materiales') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal" data-target="#modal_crear_material" title="Agregar Material">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Material') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <h3>{{ __('Materiales registrados en el Sistema') }}</h3><hr>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="search_materiales">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="search_materiales" id="search_materiales">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm table-hover table-responsive-sm tabla_materiales" id="tabla_materiales">
                                <thead style="background-color: #BAECCA">
                                    <tr>
                                        <th hidden style="border: 1px solid #C6C8CA;">#</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Nombre') }}</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Descripción') }}</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Categoría') }}</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Stock') }}</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Estado') }}</th>
                                        <th style="border: 1px solid #C6C8CA;">Op</th>
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

    @include('material.modal.modal_crear_material')
    @include('material.modal.modal_actualizar_material')
    @include('material.modal.modal_cambio_moneda')
    @include('material.modal.modal_abastecer_material')
    @include('material.modal.modal_editar_compra')
    @include('material.modal.modal_ver_material')
@endsection

@section('funciones')
    @include('material.funciones.funcion_material')
@endsection
