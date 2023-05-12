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
                        <li class="breadcrumb-item active">{{ __('Recipiente') }}</li>
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
                                <a style="color: #fff;" href="#" data-toggle="modal"  data-target="#modal_crear_recipiente" title="Agregar recipente">
                                    <i class="far fa-plus-square"></i>
                                </a>{{ __('Recipente') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <h3>{{ __('Lista de Recipientes registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_recipientes" id="tabla_recipientes">
                                <thead>
                                    <th>#</th>
                                    <th>{{ __('Descripción') }}</th>
                                    <th>{{ __('Op') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($recipientes as $recipiente)
                                        <tr>
                                            <td>{{ $recipiente->id }}</td>
                                            <td>{{ $recipiente->descripcion }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_actualizar_recipiente_{{ $recipiente->id }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                                    @include('recipiente.modal.modal_actualizar_recipiente')
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $recipiente->id }}" data-route="{{ route('recipiente.destroy', $recipiente->id) }}"><i class="fas fa-trash-alt"></i></button>
                                                    {{-- <form action="{{ url('recipientes/'.$recipiente->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button href="#" type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                                    </form> --}}
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

    @include('recipiente.modal.modal_crear_recipiente')
@endsection

@section('funciones')
    @include('recipiente.funciones.funcion_recipiente')
@endsection