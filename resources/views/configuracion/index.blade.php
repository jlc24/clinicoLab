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
                <div class="col-xl-4 col-sm-4">
                    <div class="card">
                        
                        <div class="card-body text-center">
                            <div>
                                <h3>{{ __('Logo de la Empresa') }}</h3>
                            </div>
                            <div class="mt-5 mb-5">
                                <img src="{{ asset('dist/img/default.png') }}" width="300px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                            </div>
                            <div class="text-center">
                                <form class="form-horizontal" id="form_subir_logo" action="" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label" for="photo_logo">{{ __('Cambiar Logo') }}: </label>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-11">
                                            <input type="file" name="photo_logo" id="photo_logo" accept=".jpge,.jpg,image/png" class="form-control form-control-file">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col-md-11">
                                            <button type="submit" class="btn btn-sm btn-outline-success">{{ __('Guardar cambios') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-9 col-sm-9">
                                    <h3>{{ __('Datos principales de la Empresa') }}</h3>
                                </div>
                                <div class="col-xl-3 col-sm-3 text-right">
                                    <button class="btn btn-sm btn-warning">Editar</button>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="mt-5">
                                    <div class="form-group row">
                                        <label for="conf_nombre" class="col-form-label col-md-3">{{ __('Nombre') }}:</label>
                                        <div class="col-md-8">
                                            <input type="text" value="{{ $datos->nombre }}" name="conf_nombre" id="conf_nombre" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nit" class="col-form-label col-md-3">N.I.T.:</label>
                                        <div class="col-md-8">
                                            <input type="number" value="{{ $datos->nit }}" name="nit" id="nit" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="direccion" class="col-form-label col-md-3">{{ __('Dirección') }}:</label>
                                        <div class="col-md-8">
                                            <input type="text" value="{{ $datos->direccion }}" name="direccion" id="direccion" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pais" class="col-form-label col-md-3">{{ __('País') }}:</label>
                                        <div class="col-md-8">
                                            <input type="text" value="{{ $datos->pais }}" name="pais" id="pais" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cli_departamento" class="col-form-label col-md-3">{{ __('Departamento') }}:</label>
                                        <div class="col-md-8">
                                            <select name="cli_departamento" id="cli_departamento" class="custom-select custom-select-sm">
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
                                    </div>
                                    <div class="form-group row">
                                        <label for="cli_municipio" class="col-form-label col-md-3">{{ __('Municipio') }}:</label>
                                        <div class="col-md-8">
                                            <select name="cli_municipio" id="cli_municipio" class="custom-select custom-select-sm">
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
                                    <div class="form-group row">
                                        <label for="telefono" class="col-form-label col-md-3">{{ __('Teléfono') }}/{{ __('Celular') }}:</label>
                                        <div class="col-md-8">
                                            <input type="number" value="{{ $datos->telefono }}" name="telefono" id="telefono" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="web" class="col-form-label col-md-3">{{ __('Dirección Web') }}:</label>
                                        <div class="col-md-8">
                                            <input type="text" value="{{ $datos->web }}" name="web" id="web" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row text-center">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-sm btn-outline-success">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection