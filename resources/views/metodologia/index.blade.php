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
                        <li class="breadcrumb-item active">{{ __('Metodologías') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-sm-8">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_metodologia" title="Agregar metodologia">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Metodologías') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Metodologías registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <th>#</th>
                                    <th>{{ __('Nombre') }}</th>
                                    <th>{{ __('Descripción') }}</th>
                                    <th>{{ __('Op') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($metodos as $metodo)
                                        <tr>
                                            <td>{{ $metodo->id }}</td>
                                            <td>{{ $metodo->nombre }}</td>
                                            <td>{{ $metodo->descripcion }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_actualizar_metodologia_{{ $metodo->id }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                    @include('metodologia.modal.modal_actualizar_metodologias')
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $metodo->id }}" data-route="{{ route('metodologia.destroy', $metodo->id) }}"><i class="fas fa-trash-alt"></i></button>
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

    @include('metodologia.modal.modal_crear_metodologias')
@endsection

@section('funciones')
    @include('metodologia.funciones.funcion_metodo')
@endsection