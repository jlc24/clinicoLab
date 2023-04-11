@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catálogo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Catálogo</a></li>
                        <li class="breadcrumb-item active">Estudio</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_estudio" title="Agregar estudio">
                                    <i class="far fa-plus-square"></i>
                                </a>Estudios
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>Lista de Estudios o Análisis registrados en el Sistema</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <th>#</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Op</th>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->estudio->id }}</td>
                                            <td>{{ $detalle->estudio->est_cod }}</td>
                                            <td>{{ $detalle->estudio->est_nombre }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_editar_estudio_{{ $detalle->estudio->id }}" class="btn btn-sm btn-outline-warning" title="Editar Estudio"><i class="fas fa-user-edit"></i></a>
                                                    @include('estudio.modal.modal_modificar_estudio')
                                                    <a href="javascript:void(0);" id="btnAddResultado" class="btn btn-sm btn-outline-info" title="Configurar"><i class="fas fa-cog"></i></a>
                                                    <a href="javascript:void(0);" id="btnAddResultado" class="btn btn-sm btn-outline-danger" title="Elimnar estudio"><i class="fas fa-trash-alt"></i></a>
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

    @include('estudio.modal.modal_crear_estudio')
@endsection

@section('funciones')
    @include('estudio.funciones.funciones_estudio')
@endsection