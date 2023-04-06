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
                                                <option value="" disabled selected>Seleccionar...</option>
                                                <option value="paciente">Pacientes</option>
                                                <option value="estudio">Estudios</option>
                                                <option value="fecha">Fechas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                            <form action="" method="post" id="form_buscar_paciente" style="display: none">
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
                                    <input type="hidden" placeholder="Genero" id="rec_genero" name="rec_genero" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                    <input type="hidden" placeholder="Edad" id="rec_edad" name="rec_edad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                            
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-success">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="" method="post" id="form_buscar_estudio" style="display: none">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-sm-8">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Estudio a buscar') }}:</label>
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
                                            <button type="submit" class="btn btn-success">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="" method="post" id="form_buscar_fechas" style="display: none">
                                <div class="row justify-content-center">
                                    <div class="col-xl-3 col-sm-3"></div>
                                    <div class="col-xl-9 col-sm-9">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos a buscar por fechas') }}:</label>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <input type="date" placeholder="Nombre del Estudio" id="rec_estudio_nombre" name="rec_estudio_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <input type="date" placeholder="Nombre del Estudio" id="rec_estudio_nombre" name="rec_estudio_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #fff; padding-top: 15px">
                            <h4>{{ __('Archivos') }}</h4>
                        </div>
                        <div class="car-body">
                            <table class="table table-bordered table-responsive-lg">
                                <thead class="text-center">
                                    <th>#</th>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Estudio</th>
                                    <th>Clave</th>
                                    <th>Estado</th>
                                    <th>Op</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>RUBEN POMA LOPEZ</td>
                                        <td>2023-03-30</td>
                                        <td>QUIMICA SANGUINEA VI</td>
                                        <td>2QSVI</td>
                                        <td>
                                            <a href="#" class="badge badge-danger">Pendiente</a>
                                            <a href="#" class="badge badge-warning">Resultado</a>
                                            <a href="#" class="badge badge-success">Autorizado</a>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Button group">
                                                <a href="#" class="btn btn-sm btn-warning" title="Editar resultado"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-info" title="Imprimir resultado"><i class="fas fa-print"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection