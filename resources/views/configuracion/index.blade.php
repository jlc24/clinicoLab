@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Configuración') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Configuración') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <div>
                                <h4>{{ __('Logo de la Empresa') }}</h4>
                            </div>
                            <div class="mt-4 mb-4">
                                @if($datos->logo == null)
                                    <img src="{{ asset('dist/img/default.png') }}" class="img_logo" width="250px" height="250px" style="border: 2px solid rgb(146, 144, 144); border-radius: 50%; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                                @else
                                    <img src="{{ asset($datos->logo) }}" class="img_logo" width="250px" height="250px" style="border: 2px solid rgb(146, 144, 144); border-radius: 50%; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                                @endif
                            </div>
                            <div class="text-center">
                                <div class="form-group row">
                                    <label class="col-form-label" for="photo_logo">{{ __('Cambiar Logo') }}: </label>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-10">
                                        <input type="file" name="photo_logo" id="photo_logo" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file photo_logo" onchange="VerImagen('photo_logo', 'img_logo')">
                                    </div>
                                    <div class="col-md-1 m-0 p-0 div-clear-file" hidden>
                                        <a href="javascript:void(0)" title="Borrar imagen seleccionada" class="btn-clear-file"><i class="fas fa-refresh"></i></a>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-11">
                                        <button class="btn btn-sm btn-outline-success btn-save-logo" hidden>{{ __('Guardar cambios') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-9 col-sm-12">
                                    <h4>{{ __('Datos principales de la Empresa') }}</h4>
                                </div>
                                <div class="col-xl-3 col-sm-12 text-right">
                                    <button class="btn btn-sm btn-outline-warning btn-config-edit">Editar</button>
                                    <input type="checkbox" name="chk-edit" id="chk-edit" hidden>
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_nombre" class="col-form-label col-md-3">{{ __('Nombre') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ $datos->nombre }}" name="config_nombre" id="config_nombre" class="form-control form-control-sm" disabled>
                                            <input type="hidden" value="{{ $datos->id }}" name="config_id" id="config_id" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_nit" class="col-form-label col-md-3">N.I.T.:</label>
                                        <div class="col-md-9">
                                            <input type="number" value="{{ $datos->nit }}" name="config_nit" id="config_nit" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_direccion" class="col-form-label col-md-3">{{ __('Dirección') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ $datos->direccion }}" name="config_direccion" id="config_direccion" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_pais" class="col-form-label col-md-3">{{ __('País') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ $datos->pais }}" name="config_pais" id="config_pais" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="cli_departamento" class="col-form-label col-md-3">{{ __('Departamento') }}:</label>
                                        <div class="col-md-3">
                                            <select name="cli_departamento" id="cli_departamento" class="custom-select custom-select-sm" disabled>
                                                <option value="" disabled>Seleccionar...</option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->nombre }}" 
                                                        @if ($departamento->nombre == $datos->departamento)
                                                            {{ 'selected' }}
                                                        @endif
                                                        >{{ $departamento->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="cli_municipio" class="col-form-label col-md-3">{{ __('Municipio') }}:</label>
                                        <div class="col-md-3">
                                            <select name="cli_municipio" id="cli_municipio" class="custom-select custom-select-sm" disabled>
                                                <option value="">Seleccionar...</option>
                                                @foreach ($municipios as $municipio)
                                                    <option value="{{ $municipio->nombre }}"
                                                        @if($municipio->nombre == $datos->municipio) 
                                                            {{ 'selected' }}
                                                        @endif
                                                        >{{ $municipio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_telefono" class="col-form-label col-md-3">{{ __('Teléfono') }}/{{ __('Celular') }}:</label>
                                        <div class="col-md-9">
                                            <input type="number" value="{{ $datos->telefono }}" name="config_telefono" id="config_telefono" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_email" class="col-form-label col-md-3">{{ __('Email') }}:</label>
                                        <div class="col-md-9">
                                            <input type="email" value="{{ $datos->email }}" name="config_email" id="config_email" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row">
                                        <label for="config_web" class="col-form-label col-md-3">{{ __('Dirección Web') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ $datos->web }}" name="config_web" id="config_web" class="form-control form-control-sm" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-11 col-sm-12">
                                    <div class="form-group row text-center">
                                        <button class="btn btn-sm btn-outline-success btn-config-save" hidden>Guardar Cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('funciones')
    @include('configuracion.funciones.funcion_config')
@endsection