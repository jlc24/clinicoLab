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
                        <li class="breadcrumb-item active">{{ __('Categorías') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal" data-target="#modal_crear_categoria" title="Agregar categoria">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Categoría') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Categorías registrados en el Sistema') }}</h3><hr>
                            <div class="row justify-content-end">
                                <div class="col-xl-6 col-sm-12 ">
                                    <div class="form-group row">
                                        <label class="col-md-3" for="search_categorias">Buscar:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="search_categorias" id="search_categorias">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_categorias" id="tabla_categorias">
                                <thead >
                                    <tr>
                                        <th class="text-right">#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th class="text-center">Op</th>
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

    @include('categoria.modal.modal_crear_categoria')
    @include('categoria.modal.modal_actualizar_categoria')
@endsection

@section('funciones')
    @include('categoria.funciones.funcion_categoria')
@endsection