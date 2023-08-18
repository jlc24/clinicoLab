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
                        <li class="breadcrumb-item active">{{ __('Unidades Medidda') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_medida" title="Agregar unidad" id="btnAddMedida">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Unidades de Medida') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Unidades de Medida registrados en el Sistema') }}</h3><hr>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="buscarUmedidas">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="buscarUmedidas" id="buscarUmedidas">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12">
                                <table class="table table-sm table-bordered table-hover table-responsive-sm" id="tabla_umedidas">
                                    <thead style="background-color: #BAECCA;">
                                        <th class="text-right" style="border: 1px solid #C6C8CA;">#</th>
                                        <th style="border: 1px solid #C6C8CA;">{{ __('Nombre') }}</th>
                                        <th class="text-center" style="border: 1px solid #C6C8CA;">{{ __('Unidad') }}</th>
                                        <th class="text-center" style="border: 1px solid #C6C8CA;">{{ __('Op') }}</th>
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="4" class="text-center">No se encontrados datos</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('umedida.modal.modal_crear_umedida')
    @include('umedida.modal.modal_actualizar_umedida')
@endsection

@section('funciones')
    @include('umedida.funciones.funcion_umedida')
@endsection