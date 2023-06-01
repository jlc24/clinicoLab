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
                        <li class="breadcrumb-item active">{{ __('Usuarios') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 15px;">
                            <h4 class="page-title">
                                <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_usuario" title="Agregar Usuario">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Usuario') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Usuarios registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla-usuarios" id="tabla_usuarios" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th>#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Dirección') }}</th>
                                        <th>{{ __('Rol') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->usuario_nombre }} {{ $usuario->usuario_apellido_pat }} {{ $usuario->usuario_apellido_mat }}</td>
                                            <td>{{ $usuario->usuario_direccion }}</td>
                                            <td>{{ $usuario->user->rol }}</td>
                                            <td class="text-center">
                                                @if ($usuario->user->rol !== 'admin')
                                                    @if($usuario->user->estado == '1')
                                                        <a href="javascript:void(0)" class="badge badge-success">ACTIVO</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="badge badge-danger">INACTIVO</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($usuario->user->rol !== 'admin')
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button data-toggle="modal" data-target="#modal_actualizar_usuario" class="btnEditarUsuario btn btn-sm btn-outline-warning" title="Editar Usuario"><i class="fas fa-user-edit"></i></button>
                                                        <button data-toggle="modal" data-target="#modal_ver_usuario" class="btn btn-sm btn-outline-success" title="Ver Usuario"><i class="fas fa-eye"></i></button>
                                                        <button data-toggle="modal" data-target="#modal_ver_usuario" class="btn btn-sm btn-outline-info" title="Asignar permisos"><i class="fas fa-cog"></i></button>
                                                    </div>
                                                @endif
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

    @include('user.modal.modal_crear_usuario')
    @include('user.modal.modal_actualizar_usuario')
@endsection

@section('funciones')
    @include('user.funciones.funcion_user')
@endsection