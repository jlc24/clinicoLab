@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Administración') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Administración') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Pacientes') }}</li>
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
                                <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Agregar Cliente">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nuevo Paciente') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Pacientes registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla-clientes" id="tabla_clientes" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th>#</th>
                                        <th>{{ __('Codigo') }}</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Apellido Paterno') }}</th>
                                        <th>{{ __('Apellido Materno') }}</th>
                                        <th>{{ __('Celular') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->cli_cod }}</td>
                                            <td>{{ $cliente->cli_nombre }}</td>
                                            <td>{{ $cliente->cli_apellido_pat }}</td>
                                            <td>{{ $cliente->cli_apellido_mat }}</td>
                                            <td>{{ $cliente->cli_celular }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_cliente_{{ $cliente->id }}" class="btnEditarCliente btn btn-sm btn-outline-warning" title="Editar Paciente"><i class="fas fa-user-edit"></i></button>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_ver_cliente" class="btn btn-sm btn-outline-info btnVerCliente" title="Mostrar Informacion del Paciente"><i class="fas fa-info-circle"></i></a>
                                                    <a href="javascript:void(0);" id="btnAddRecepcion" class="btn btn-sm btn-outline-danger btnAddRecepcion" title="Recepcionar Estudio"><i class="fas fa-keyboard"></i></a>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_ver_resultado" id="btnVerResultados" class="btn btn-sm btn-outline-success btnVerResultados" title="Ver resultados"><i class="fas fa-eye"></i></a>
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_ver_factura" id="btnVerFacturas" class="btn btn-sm btn-outline-primary btnVerFacturas" title="Ver Facturas"><i class="fas fa-file-archive"></i></a>
                                                    {{-- <a href="javascript:void(0);" id="btnVerReporte" class="btn btn-sm btn-outline-secondary" title="ver Reporte"><i class="fas fa-file"></i></a> --}}
                                                </div>
                                            </td>
                                            @include('cliente.modal.modal_actualizar_cliente')
                                            
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
    
    @include('cliente.modal.modal_crear_cliente')
    @include('cliente.modal.modal_ver_cliente')
    @include('cliente.modal.modal_ver_resultado')
    @include('cliente.modal.modal_ver_facturas')
    @include('cliente.modal.modal_ver_resultadopdf')
@endsection

@section('funciones')
    @include('cliente.funciones.funciones_cliente')
@endsection
