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
                        <li class="breadcrumb-item active">{{ __('Cajas') }}</li>
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
                                <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_caja" title="Abrir Caja">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Cajas') }}
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_cliente">
                            <h3>{{ __('Lista de Pacientes registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th>#</th>
                                        <th>{{ __('Usuario') }}</th>
                                        <th>{{ __('Fecha Apertura') }}</th>
                                        <th>{{ __('Monto Inicial') }}</th>
                                        <th>{{ __('Fecha Cierre') }}</th>
                                        <th>{{ __('Monto Final') }}</th>
                                        <th>{{ __('Cambio') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cajas as $caja)
                                        <tr>
                                            <td>{{ $caja->id }}</td>
                                            <td>{{ $caja->user->user }}</td>
                                            <td>{{ $caja->created_at }}</td>
                                            <td>{{ $caja->caja_monto_inicial }}</td>
                                            <td>
                                                @if($caja->updated_at != $caja->created_at)
                                                    {{ $caja->updated_at }}
                                                @endif
                                            </td>
                                            <td>{{ $caja->caja_monto_final }}</td>
                                            <td>{{ $caja->caja_cambio }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    @if($caja->caja_estado == '1')
                                                        <button data-toggle="modal" data-target="#modal_actualizar_caja_{{ $caja->id }}" class="btnEditarCaja btn btn-sm btn-outline-warning" title="Cerrar Caja"><i class="fas fa-lock-open"></i></button>
                                                        @include('caja.modal.modal_actualizar_caja')
                                                    @else
                                                        <button class="btn btn-sm btn-danger" title="Caja Cerrada"><i class="fas fa-lock" disabled></i></button>
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

    @include('caja.modal.modal_crear_caja')
@endsection

@section('funciones')
    @include('caja.funciones.funcion_caja')
@endsection