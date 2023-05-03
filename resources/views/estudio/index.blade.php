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
                <div class="col-xl-10 col-sm-10">
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
                            <table class="table table-bordered table-responsive-lg table_estudios" id="tabla_estudios">
                                <thead>
                                    <th>#</th>
                                    <th>Clave</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Op</th>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->id }}</td>
                                            <td>{{ $detalle->estudio->est_cod }}</td>
                                            <td>{{ $detalle->estudio->est_nombre }}</td>
                                            <td class="text-center">
                                                @if($detalle->tipo == null || $detalle->tipo == 'DESHABILITADO')
                                                    <a href="#" class="badge badge-danger btn-tipo-estudio" title="Tipo Estudio" style="font-size: 15px">Deshabilitado</a>
                                                @elseif ($detalle->tipo == 'HABILITADO')
                                                    <a href="#" class="badge badge-success btn-tipo-individual" title="Tipo Estudio" style="font-size: 15px">Habilitado</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button data-toggle="modal" data-target="#modal_editar_estudio_{{ $detalle->id }}" class="btn btn-sm btn-outline-warning" title="Editar Estudio"><i class="fas fa-user-edit"></i></button>
                                                    @include('estudio.modal.modal_modificar_estudio')
                                                    @if ($detalle->tipo == 'HABILITADO')
                                                        <button data-id="{{ $detalle->id }}" data-nombre="{{ $detalle->estudio->est_nombre }}" data-toggle="modal" data-target="#modal_configurar_estudio_individual_{{ $detalle->id }}" class="btn btn-sm btn-outline-info btn-detalle-indi-id" title="Configurar Estudio Individual"><i class="fas fa-cog"></i></button>
                                                        @include('estudio.modal.modal_config_estudio_individual')
                                                        <button href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-delete-estudio" title="Elimnar estudio"><i class="fas fa-trash-alt"></i></button>
                                                    @endif
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
    @include('procedimiento.modal.modal_crear_procedimiento')
    @include('componente.modal.modal_crear_componente')
    @include('estudio.modal.modal_config_parametro')
@endsection

@section('funciones')
    @include('estudio.funciones.funciones_estudio')
@endsection