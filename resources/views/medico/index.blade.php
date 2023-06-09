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
                        <li class="breadcrumb-item active">{{ __('Médicos') }}</li>
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
                                <a style="color: #32C861;" href="#" data-toggle="modal"  data-target="#modal_crear_medico" title="Agregar medico">
                                    <i class="far fa-plus-square"></i>
                                </a> {{ __('Registrar Médico') }}
                            </h4>
                        </div>
                        <div class="card-body" id="tabla_medico">
                            <h3>{{ __('Lista de Medicos registrados en el Sistema') }}</h3><hr>
                            <table class="table table-bordered table-sm table-hover table-responsive-lg tabla_medicos" id="tabla_medicos">
                                <thead style="text-align: center;">
                                    <tr class="table-info">
                                        <th>#</th>
                                        <th>{{ __('Código') }}</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Apellido Paterno') }}</th>
                                        <th>{{ __('Apellido Materno') }}</th>
                                        <th>{{ __('Contacto') }}</th>
                                        <th>Op</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicos as $medico)
                                        <tr>
                                            <td>{{ $medico->id }}</td>
                                            <td>{{ $medico->med_cod }}</td>
                                            <td>{{ $medico->med_nombre }}</td>
                                            <td>{{ $medico->med_apellido_pat }}</td>
                                            <td>{{ $medico->med_apellido_mat }}</td>
                                            <td>{{ $medico->med_celular }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <button data-toggle="modal" data-target="#modal_actualizar_medico_{{ $medico->id }}" class="btn btn-sm btn-outline-warning" ><i class="fas fa-user-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#modal_ver_medico_{{ $medico->id }}" class="btn btn-sm btn-outline-info"><i class="fas fa-info-circle"></i></button>
                                                    @if(Auth::user()->rol == 'admin')
                                                        <button data-toggle="modal" data-target="#modal_asginar_permiso" class="btn btn-sm btn-outline-success btnPermisoMedico" title="Asignar permisos"><i class="fas fa-cog"></i></button>
                                                    @endif
                                                </div>
                                            </td>
                                            @include('medico.modal.modal_actualizar_medico')
                                            @include('medico.modal.modal_ver_medico')
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{-- {{ Auth::user()->permiso_user->usuario_id }} --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('medico.modal.modal_crear_medico')
    @if(Auth::user()->rol == 'admin')
        @include('permiso.modal.modal_asignar_permisos')
    @endif
@endsection

@section('funciones')
    @include('medico.funciones.funciones_medico')
@endsection