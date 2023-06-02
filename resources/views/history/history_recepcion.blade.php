@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Captura') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Captura') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Historial') }}</li>
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
                                 {{ __('Historial de pacientes recepcionados') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-xl-2 col-sm-6">
                                    <div class="form-group row text-center">
                                        <label for="filtrar_fecha" class="form-label col-md-12">FECHAS</label>
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="date" id="filtrar_fecha" name="filtrar_fecha" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6">
                                    <div class="form-group row text-center">
                                        <label for="filtrar_estudio" class="form-label col-md-12">ESTUDIOS</label>
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select class="custom-select custom-select-sm" id="filtrar_estudio" name="filtrar_estudio" >
                                                <option value="" selected>TODO</option>
                                                @foreach ($estudios as $estudio)
                                                    <option value="{{ $estudio->id }}">{{ $estudio->est_nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-6">
                                    <div class="form-group row text-center">
                                        <label for="filtrar_caja" class="form-label col-md-12">CAJA</label>
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select class="custom-select custom-select-sm" id="filtrar_caja" name="filtrar_caja" >
                                                <option value="" selected>TODO</option>
                                                @foreach ($cajas as $caja)
                                                    <option value="{{ $caja->id }}">{{ $caja->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->rol == 'admin')
                                    <div class="col-xl-3 col-sm-6">
                                        <div class="form-group row text-center">
                                            <label for="filtrar_usuario" class="form-label col-md-12">USUARIOS</label>
                                            <div class="col-md-12" style="display: inline-flex">
                                                <select class="custom-select custom-select-sm" id="filtrar_usuario" name="filtrar_usuario" >
                                                    <option value="" selected>TODO</option>
                                                    @foreach ($usuarios as $usuario)
                                                        <option value="{{ $usuario->id }}">{{ $usuario->usuario->usuario_nombre }} {{ $usuario->usuario->usuario_apellido_pat }} {{ $usuario->usuario->usuario_apellido_mat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <table class="table table-bordered table-sm table-hover table-responsive-lg tabla-historial-recepcion" id="tabla-historial-recepcion" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead style="text-align: center;">
                                            <tr class="table-info">
                                                <th hidden>#</th>
                                                <th>{{ __('Fecha') }}</th>
                                                <th>{{ __('Paciente') }}</th>
                                                <th>{{ __('Estudio') }}</th>
                                                <th>{{ __('Código') }}</th>
                                                <th>{{ __('Estado') }}</th>
                                                <th>Op</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recepcions as $recepcion)
                                                <tr>
                                                    <td hidden>{{ $recepcion->rec_id }}</td>
                                                    <td>{{ $recepcion->fecha }}</td>
                                                    <td>{{ $recepcion->nombre }}</td>
                                                    <td>{{ $recepcion->est_nombre }}</td>
                                                    <td>{{ $recepcion->est_cod }}</td>
                                                    <td class="text-center">
                                                        @if($recepcion->estado == 'PENDIENTE')
                                                            <span class="badge badge-danger">{{ $recepcion->estado }}</span>
                                                        @else
                                                            <span class="badge badge-success">{{ $recepcion->estado }}</span>
                                                        @endif
                                                    <td class="text-center">
                                                        @if($recepcion->estado == 'PENDIENTE')
                                                            <button class="btn btn-sm btn-outline-warning" title="Notificar"><i class="fas fa-message"></i></button>
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
            </div>
        </div>
    </section>
@endsection

@section('funciones')
    @include('history.funciones.funcion_history')
@endsection