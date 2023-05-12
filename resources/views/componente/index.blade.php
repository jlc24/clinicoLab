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
                        <li class="breadcrumb-item active">{{ __('Componente') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal" data-target="#modal_crear_componente" title="Agregar Componente">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Componente') }}
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_cliente">
                            <h3>{{ __('Lista de Componentes registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($componentes as $componente)
                                        <tr>
                                            <td>{{ $componente->id }}</td>
                                            <td>{{ $componente->nombre }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_componente_{{ $componente->id }}" class="btnEditarComponente btn btn-sm btn-outline-warning" title="Editar Componente"><i class="fas fa-user-edit"></i></button>
                                                    @include('componente.modal.modal_actualizar_componente')
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $componente->id }}" data-route="{{ route('componente.destroy', $componente->id) }}"><i class="fas fa-trash-alt"></i></button>
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

    @include('componente.modal.modal_crear_componente')
@endsection

@section('funciones')
    @include('componente.funciones.funcion_componente')
@endsection