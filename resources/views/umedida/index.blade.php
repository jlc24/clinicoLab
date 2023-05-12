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
                        <li class="breadcrumb-item active">{{ __('Unidades Medidda') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-sm-7">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_medida" title="Agregar unidad">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Unidades de Medida') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Unidades de Medida registrados en el Sistema') }}</h3><hr>
                            <table class="table table-sm table-bordered table-hover table-responsive-lg tabla_umedidas text-center" id="tabla_umedidas">
                                <thead>
                                    <th>#</th>
                                    <th>{{ __('Unidad') }}</th>
                                    <th>{{ __('Op') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($medidas as $medida)
                                        <tr>
                                            <td>{{ $medida->id }}</td>
                                            <td>{{ $medida->unidad }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_actualizar_medida_{{ $medida->id }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                    @include('umedida.modal.modal_actualizar_umedida')
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $medida->id }}" data-route="{{ route('umedida.destroy', $medida->id) }}"><i class="fas fa-trash-alt"></i></button>
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

    @include('umedida.modal.modal_crear_umedida')
@endsection

@section('funciones')
    @include('umedida.funciones.funcion_umedida')
@endsection