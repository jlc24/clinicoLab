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
                        <li class="breadcrumb-item active">Médicos</li>
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
                                <a style="color: #32C861;" href="#" data-toggle="modal"  data-target="#modal_crear_medico" title="Agregar medico">
                                    <i class="far fa-plus-square"></i>
                                </a> Registrar Medico
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_medico">
                            <h3>Lista de Medicos registrados en el Sistema</h3><hr>
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
                                    @foreach ($medicos as $medico)
                                        <tr>
                                            <td>{{ $medico->id }}</td>
                                            <td>{{ $medico->med_cod }}</td>
                                            <td>{{ $medico->med_nombre }}</td>
                                            <td>{{ $medico->med_apellido_pat }}</td>
                                            <td>{{ $medico->med_apellido_mat }}</td>
                                            <td>{{ $medico->med_correo }}</td>
                                            <td>{{ $medico->med_usuario }}</td>
                                            <td>{{ $medico->med_password }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button class="btn btn-sm btn-outline-warning"><i class="fas fa-user-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                                    <button class="btn btn-sm btn-outline-success"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-file"></i></button>
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
    @include('medico.modal.modal_crear_medico')
@endsection