@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administración</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Administración</a></li>
                        <li class="breadcrumb-item active">Pacientes</li>
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
                                </a> Nuevo Paciente
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_cliente">
                            <h3>Lista de Pacientes registrados en el Sistema</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Correo</th>
                                        <th>Usuario</th>
                                        <th>Contraseña</th>
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
                                            <td>{{ $cliente->cli_correo }}</td>
                                            <td>{{ $cliente->cli_usuario }}</td>
                                            <td>{{ $cliente->cli_password }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="{{ route('cliente.edit', $cliente->id) }}" data-toggle="modal" data-target="#modal_update_cliente" class="btn btn-sm btn-outline-warning" title="Editar Paciente"><i class="fas fa-user-edit"></i></a>
                                                    <a href="javascript:void(0);" id="btnVerCliente" class="btn btn-sm btn-outline-info" title="Mostrar Informacion del Paciente"><i class="fas fa-info-circle"></i></a>
                                                    <a href="javascript:void(0);" id="btnAddResultado" class="btn btn-sm btn-outline-danger" title="Generar Resultado"><i class="fas fa-shop"></i></a>
                                                    <a href="javascript:void(0);" id="btnVerResultados" class="btn btn-sm btn-outline-success" title="Ver resultados"><i class="fas fa-eye"></i></a>
                                                    <a href="javascript:void(0);" id="btnVerReporte" class="btn btn-sm btn-outline-secondary" title="ver Reporte"><i class="fas fa-file"></i></a>
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
    
    @include('cliente.modal.modal_crear_cliente')
    
    @include('cliente.modal.modal_modificar_cliente')
    
@endsection
