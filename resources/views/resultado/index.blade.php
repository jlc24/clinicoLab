@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Captura') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Captura') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Resultados') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-sm-10">
                    <div class="card">
                        <div class="card-header" style="background-color: #E8F8ED; height: 50px; padding-top: 15px;">
                            <h4 class="page-title">
                                {{ __('Resultados') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6">
                                    <h3>{{ __('Lista de Resultados') }}</h3>
                                </div>
                                <div class="col-xl-6 col-sm-6">
                                    <div class="form-group row">
                                        <label for="buscar_resultado" class="col-form-label col-md-3">{{ __('Buscar por') }}:</label>
                                        <div class="col-md-8">
                                            <select name="buscar_resultado" id="buscar_resultado" class="custom-select custom-select" onchange="buscarPor()">
                                                <option value="paciente" selected>Pacientes</option>
                                                <option value="estudio">Estudios</option>
                                                <option value="fecha">Fechas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                            <div id="form_buscar_paciente">
                                <div class="row justify-content-center">
                                    <div class="col-xl-10 col-sm-10">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Paciente a buscar') }}:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="hidden" name="rec_paciente_id" id="rec_paciente_id">
                                                <input type="text" placeholder="Clave Paciente" id="rec_paciente_clave" name="rec_paciente_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre del Paciente" id="rec_paciente_nombre" name="rec_paciente_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <button class="btn btn-success" id="btnBuscarPaciente">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form_buscar_estudio" style="display: none">
                                <div class="row justify-content-center">
                                    <div class="col-xl-10 col-sm-10">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Estudio a buscar') }}:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="hidden" name="rec_estudio_id" id="rec_estudio_id">
                                                <input type="text" placeholder="Clave Estudio" id="rec_estudio_clave" name="rec_estudio_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-clipboard-list"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre del Estudio" id="rec_estudio_nombre" name="rec_estudio_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <button class="btn btn-success" id="btnBuscarEstudio">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form_buscar_fechas" style="display: none">
                                <div class="row justify-content-center">
                                    <div class="col-xl-3 col-sm-3"></div>
                                    <div class="col-xl-9 col-sm-9">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos a buscar por fechas') }}:</label>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <input type="date" id="rec_fecha_inicio" name="rec_fecha_inicio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <input type="date" id="rec_fecha_final" name="rec_fecha_final" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success" id="btnBuscarFechas">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #fff; padding-top: 15px">
                            <h4>{{ __('Recepcionados') }}</h4>
                        </div>
                        <div class="car-body">
                            <div class="row m-1">
                                @include('resultado.tablas.tabla_resultados')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('funciones')
    @include('resultado.funciones.funciones_resultado')
@endsection