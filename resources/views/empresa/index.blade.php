@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Administración') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Administración') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Empresas') }}</li>
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
                                <a style="color: #32C861;" href="#" data-toggle="modal" data-target="#modal_crear_empresa" title="Agregar empresa">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Nueva Empresa') }}
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_empresa">
                            <h3>{{ __('Lista de Empresas registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_empresas" id="tabla_empresas">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        @if(Auth::user()->rol == 'admin')
                                            <th>#</th>
                                        @else
                                            <th hidden>#</th>
                                        @endif
                                        <th>{{ __('Codigo') }}</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('NIT') }}</th>
                                        <th>{{ __('Dirección') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empresas as $empresa)
                                        <tr>
                                            @if(Auth::user()->rol == 'admin')
                                                <td>{{ $empresa->id }}</td>
                                            @else
                                                <td hidden>{{ $empresa->id }}</td>
                                            @endif
                                            <td>{{ $empresa->emp_cod }}</td>
                                            <td>{{ $empresa->emp_nombre }}</td>
                                            <td>{{ $empresa->emp_nit }}</td>
                                            <td>{{ $empresa->emp_direccion }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="#" data-toggle="modal" data-target="#modal_actualizar_empresa_{{ $empresa->id }}" class="btn btn-sm btn-outline-warning" title="Editar Empresa"><i class="fas fa-user-edit"></i></a>
                                                    @include('empresa.modal.modal_actualizar_empresa')
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
    
    @include('empresa.modal.modal_crear_empresa')
@endsection

@section('funciones')
    @include('empresa.funciones.funciones_empresa')
@endsection