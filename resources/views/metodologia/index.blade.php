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
                        <li class="breadcrumb-item active">{{ __('Metodologías') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_metodologia" title="Agregar metodologia">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Metodologías') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <h3>{{ __('Metodologías registrados en el Sistema') }}</h3><hr>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="buscarMetodos">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="buscarMetodos" id="buscarMetodos">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_metodologias" id="tabla_metodologias">
                                        <thead style="background-color: #BAECCA">
                                            <tr>
                                                <th style="border: 1px solid #C6C8CA;" class="text-right">#</th>
                                                <th style="border: 1px solid #C6C8CA;">{{ __('Nombre') }}</th>
                                                <th style="border: 1px solid #C6C8CA;" class="text-center">{{ __('Descripción') }}</th>
                                                <th style="border: 1px solid #C6C8CA;" class="text-center">{{ __('Op') }}</th>
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

    @include('metodologia.modal.modal_crear_metodologias')
    @include('metodologia.modal.modal_actualizar_metodologias')
@endsection

@section('funciones')
    @include('metodologia.funciones.funcion_metodo')
@endsection