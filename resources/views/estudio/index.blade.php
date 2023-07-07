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
                        <li class="breadcrumb-item active">{{ __('Estudio') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_estudio" title="Agregar estudio" class="btnAddEstudio">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Estudios') }}
                            </h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-xl-8 col-sm-8">
                                    <h4>{{ __('Lista de Estudios o Análisis registrados en el Sistema') }}</h4>
                                </div>
                            </div>
                            <div class="row table-responsive-lg">
                                <table class="table table-bordered table-hover tabla_estudios" id="tabla_estudios">
                                    <thead>
                                        <th>#</th>
                                        <th>{{ __('Clave') }}</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th hidden>{{ __('Precio') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>Op</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalles as $detalle)
                                            <tr>
                                                <td>{{ $detalle->id }}</td>
                                                <td>{{ $detalle->estudio->est_cod }}</td>
                                                <td>{{ $detalle->estudio->est_nombre }}</td>
                                                <td hidden>{{ $detalle->estudio->est_precio }}</td>
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
                                                            <button data-toggle="modal" data-target="#modal_agregar_material" class="btn btn-sm btn-outline-primary btn-add-material-estudio" title="Agregar Material"><i class="fas fa-book"></i></button>
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
        </div>
    </section>

    @include('estudio.modal.modal_crear_estudio')
    @include('procedimiento.modal.modal_crear_procedimiento')
    @include('componente.modal.modal_crear_componente')
    @include('aspecto.modal.modal_crear_aspecto')
    @include('estudio.modal.modal_config_parametro')
    @include('estudio.modal.modal_agregar_material')
    @include('estudio.modal.modal_crear_grupo')
    @include('estudio.modal.modal_crear_subgrupo')
@endsection

@section('funciones')
    @include('estudio.funciones.funciones_estudio')
@endsection