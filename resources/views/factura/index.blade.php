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
                                {{ __('Lista de Facturas recepcionadas') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla-facturas" id="tabla_facturas" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th hidden>id</th>
                                        <th>#</th>
                                        <th>{{ __('Fecha') }}</th>
                                        <th>{{ __('Hora') }}</th>
                                        <th>{{ __('Paciente') }}</th>
                                        <th>{{ __('Usuario') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $factura)
                                        <tr>
                                            <td hidden>{{ $factura->factura }}</td>
                                            <td>{{ $factura->num_factura }}</td>
                                            <td>{{ $factura->fecha }}</td>
                                            <td>{{ $factura->hora }}</td>
                                            <td>{{ $factura->nombre }}</td>
                                            <td>{{ $factura->nom_user }}</td>
                                            <td><span class="badge badge-success">{{ __('CANCELADO') }}</span></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-outline-info btn-show-factura" title="Ver Factura"><i class="fas fa-eye"></i></button>
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
@endsection

@section('funciones')
    @include('factura.funciones.funcion_factura')
@endsection