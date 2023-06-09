@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Herramientas') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Herramientas') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Facturas') }}</li>
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
                                {{ __('Lista de Resultados recepcionadas') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla-results" id="tabla-results" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th hidden>id</th>
                                        <th>{{ __('Código') }}</th>
                                        <th>{{ __('Fecha') }}</th>
                                        <th>{{ __('Hora') }}</th>
                                        <th>{{ __('Paciente') }}</th>
                                        <th>{{ __('Estudio') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td hidden>{{ $result->numero }}</td>
                                            <td>{{ $result->rec_codigo }}</td>
                                            <td>{{ $result->fecha }}</td>
                                            <td>{{ $result->hora }}</td>
                                            <td>{{ $result->nombre }}</td>
                                            <td>{{ $result->estudio }}</td>
                                            <td><span class="badge badge-success">{{ $result->estado }}</span></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-info btn-show-resultado" title="Ver Resultado"><i class="fas fa-eye"></i></button>
                                                    @if(Auth::user()->rol == 'admin')
                                                        <button data-toggle="modal" data-target="#confirmPassword" class="btn btn-sm btn-outline-warning btn-generate-resultado" title="Generar Resultado"><i class="fas fa-file"></i></button>
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

    @include('cliente.modal.modal_ver_resultadopdf')
    @include('confirmacion.modal_confirmacion')
@endsection

@section('funciones')
    @include('result.funciones.funcion_results')
@endsection