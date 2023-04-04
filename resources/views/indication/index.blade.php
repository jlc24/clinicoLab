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
                        <li class="breadcrumb-item active">{{ __('Indicaciones') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_indicacion" title="Agregar indicacion">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Indicaciones') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Indicaciones registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <th>#</th>
                                    <th>{{ __('Nombre') }}</th>
                                    <th>{{ __('Descripcion') }}</th>
                                    <th>{{ __('Op') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($indications as $indication)
                                        <tr>
                                            <td>{{ $indication->id }}</td>
                                            <td>{{ $indication->nombre }}</td>
                                            <td>{{ $indication->descripcion }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_actualizar_indicacion_{{ $indication->id }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                    @include('indication.modal.modal_actualizar_indications')
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $indication->id }}" data-route="{{ route('indication.destroy', $indication->id) }}"><i class="fas fa-trash-alt"></i></button>
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

    @include('indication.modal.modal_crear_indications')
@endsection