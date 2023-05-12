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
                            <h3>{{ __('Lista de Categorías registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_categorias" id="tabla_categorias">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->id }}</td>
                                            <td>{{ $categoria->nombre }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_categoria" class="btn btn-sm btn-outline-warning btnEditarCategoria" id="btnEditarCategoria" title="Editar Categoria"><i class="fas fa-user-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-categoria"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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