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
                            <h3>{{ __('Lista de Materiales registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-sm tabla_materiales" id="tabla_materiales">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Descripción') }}</th>
                                        <th>{{ __('Categoría') }}</th>
                                        <th>{{ __('Stock') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materiales as $material)
                                        <tr>
                                            <td>{{ $material->id }}</td>
                                            <td>{{ $material->mat_nombre }}</td>
                                            <td>{{ $material->mat_descripcion }}</td>
                                            <td>{{ ($material->categoria->nombre == null ? '' : $material->categoria->nombre) }}</td>
                                            <td>{{ $material->mat_cantidad - $material->mat_ventas }}</td>
                                            <td class="text-center">
                                                @if($material->mat_estado == '1')
                                                    <button class="btn btn-sm btn-success btn-inactivo">ACTIVO</button>
                                                @else
                                                    <button class="btn btn-sm btn-danger btn-activo">INACTIVO</button>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_material" class="btn btn-sm btn-outline-warning btnEditarMaterial" id="btnEditarMaterial" title="Editar Material"><i class="fas fa-user-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#modal_abastecer_material" class="btn btn-sm btn-outline-success btnAbastecerMaterial" id="btnAbastecerMaterial" title="Abastecer Material"><i class="fas fa-warehouse"></i></button>
                                                    <button data-toggle="modal" data-target="#modal_ver_material" class="btn btn-sm btn-outline-info btnVerMaterial" id="btnVerMaterial" title="Ver Material"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger btn-delete-material" title="Elminar material"><i class="fas fa-trash-alt"></i></button>
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

    @include('material.modal.modal_crear_material')
    @include('material.modal.modal_actualizar_material')
    @include('material.modal.modal_cambio_moneda')
    @include('material.modal.modal_abastecer_material')
    @include('material.modal.modal_ver_material')
@endsection

@section('funciones')
    @include('material.funciones.funcion_material')
@endsection
