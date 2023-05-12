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
                        <li class="breadcrumb-item active">{{ __('Proveedores') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal" data-target="#modal_crear_proveedor" title="Agregar Proveedor">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Proveedor') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Proveedores registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_proveedores" id="tabla_proveedores">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th >#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Direccion') }}</th>
                                        <th>{{ __('Empresa') }}</th>
                                        <th>{{ __('Contacto') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedor)
                                        <tr>
                                            <td >{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->prov_nombre }}</td>
                                            <td>{{ $proveedor->prov_direccion }}</td>
                                            <td>
                                                @if($proveedor->empresa != null)
                                                {{ $proveedor->empresa->emp_nombre }}
                                                @endif
                                            </td>
                                            <td>{{ $proveedor->prov_telefono }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_proveedor" class="btn btn-sm btn-outline-warning btnEditarproveedor" id="btnEditarproveedor" title="Editar Proveedor"><i class="fas fa-user-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#modal_ver_proveedor" class="btn btn-sm btn-outline-info btnVerproveedor" id="btnVerproveedor" title="Ver Proveedor"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-proveedor" title="Eliminar Proveedor"><i class="fas fa-trash-alt"></i></button>
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

    @include('proveedor.modal.modal_crear_proveedor')
    @include('proveedor.modal.modal_actualizar_proveedor')
@endsection

@section('funciones')
    @include('proveedor.funciones.funcion_proveedor')
@endsection