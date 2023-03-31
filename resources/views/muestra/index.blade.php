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
                        <li class="breadcrumb-item active">{{ __('Muestras') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_muestra" title="Agregar muestra">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Tipos de Muestras') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Muestras registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-responsive-lg">
                                <thead>
                                    <th>#</th>
                                    <th>{{ __('Nombre') }}</th>
                                    <th>{{ __('Descripción') }}</th>
                                    <th>{{ __('Op') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($muestras as $muestra)
                                        <tr>
                                            <td>{{ $muestra->id }}</td>
                                            <td>{{ $muestra->nombre }}</td>
                                            <td>{{ $muestra->descripcion }}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                <a href="" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a>
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

    @include('muestra.modal.modal_crear_muestra')
@endsection