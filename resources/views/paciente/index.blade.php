@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Resultados') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Resultados') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Paciente') }}</li>
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
                                 {{ __('Resultados de examenes') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-responsive-lg" id="tabla_resultados" style="border: 1px solid #C6C8CA;">
                                <thead style="background-color: #BAECCA">
                                    <th style="border: 1px solid #C6C8CA;" hidden>id</th>
                                    <th style="border: 1px solid #C6C8CA;">Codigo</th>
                                    <th style="border: 1px solid #C6C8CA;">Clave</th>
                                    <th style="border: 1px solid #C6C8CA;">Estudio</th>
                                    <th style="border: 1px solid #C6C8CA;">Fecha</th>
                                    <th style="border: 1px solid #C6C8CA;">Estado</th>
                                    <th style="border: 1px solid #C6C8CA;">Op</th>
                                </thead>
                                <tbody>
                                    @if($estudios == null)
                                        <tr>
                                            <td colspan="7" class="text-center" style="border: 1px solid #C6C8CA;">No hay datos recepcionados</td>
                                        </tr>
                                    @else
                                        @foreach ($estudios as $estudio)
                                            <tr>
                                                <td hidden>{{ $estudio->factura }}</td>
                                                <td hidden>{{ $estudio->rec_id }}</td>
                                                <td>{{ $estudio->rec_codigo }}</td>
                                                <td>{{ $estudio->est_cod }}</td>
                                                <td>{{ $estudio->est_nombre }}</td>
                                                <td>{{ $estudio->fecha }}</td>
                                                <td class="text-center">
                                                    @if($estudio->estado == 'PENDIENTE')
                                                        <span class="badge badge-danger">{{ $estudio->estado }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ $estudio->estado }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-success btn-ver-resultados" title="Ver resultado" @if ($estudio->estado == 'PENDIENTE') {{ 'hidden' }} @else {{ '' }} @endif><i class="fas fa-eye"></i></button>
                                                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-info btn-ver-factura" title="Ver factura" @if ($estudio->estado == 'PENDIENTE') {{ 'hidden' }} @else {{ '' }} @endif><i class="fas fa-file"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('cliente.modal.modal_ver_resultadopdf')
@endsection

@section('funciones')
    @include('paciente.funciones.funcion_paciente')
@endsection