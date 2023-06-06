@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Administración') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Administración') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Permisos') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal" data-target="#modal_crear_permiso" title="Agregar Permisos">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Permiso') }}
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_cliente">
                            <h3>{{ __('Lista de Permisos registrados en el Sistema') }}</h3><hr>
                            <table class="table table-sm table-bordered table-responsive-lg tabla-permisos" id="tabla-permisos">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Descripción') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>{{ $permiso->id }}</td>
                                            <td>{{ $permiso->permiso }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_componente" class="btnEditarComponente btn btn-sm btn-outline-warning" title="Editar Componente"><i class="fas fa-user-edit"></i></button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete"><i class="fas fa-trash-alt"></i></button>
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

    @include('permiso.modal.modal_crear_permiso')
@endsection

@section('funciones')
    @include('permiso.funciones.funcion_permiso')
@endsection