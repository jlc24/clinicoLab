@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Recepción</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Captura</a></li>
                        <li class="breadcrumb-item active">Recepción</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                DATOS DE RECEPCION
                            </h4>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Paciente a recepcionar') }}:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="text" placeholder="Clave Paciente" id="rec_paciente_clave" name="rec_paciente_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                {{-- <small><span style="color: red;" id="error_rec_paciente_clave">(Se requiere Nombre)</span></small> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            {{-- <label class="col-md-12 col-form-label" for="med_apellido_pat">{{ __('Apellido Paterno') }}:</label> --}}
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-user"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre del Paciente" id="rec_paciente_nombre" name="rec_paciente_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px; "><a href=""><i class="fas fa-user-plus"></i></a> </div>
                                                </div>
                                                {{-- <small><span style="color: red;" id="error_med_apellido">(Se requiere Apellido)</span></small> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            {{-- <label class="col-md-12 col-form-label" for="med_apellido_mat">{{ __('Apellido Materno') }}:</label> --}}
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Genero" id="rec_genero" name="rec_genero" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                                {{-- <small><span style="color: red;" id="error_med_apellido">(Se requiere Apellido)</span></small> --}}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Edad" id="rec_edad" name="rec_edad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                                {{-- <small><span style="color: red;" id="error_med_apellido">(Se requiere Apellido)</span></small> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos de la Empresa a recepcionar') }}: (Opcional)</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="text" placeholder="Clave Empresa" id="rec_empresa_clave" name="rec_empresa_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                {{-- <small><span style="color: red;" id="error_rec_Empresa_clave">(Se requiere Nombre)</span></small> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            {{-- <label class="col-md-12 col-form-label" for="med_apellido_pat">{{ __('Apellido Paterno') }}:</label> --}}
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-building"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre de la Empresa" id="rec_empresa_nombre" name="rec_empresa_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4">
                                        <div class="form-group row">
                                            {{-- <label class="col-md-12 col-form-label" for="med_apellido_mat">{{ __('Apellido Materno') }}:</label> --}}
                                            <div class="col-md-12">
                                                <select class="custom-select custom-select-sm" id="med_ci_nit_exp" name="med_ci_nit_exp" required>
                                                    <option value="" selected="" disabled>TIPO DE CONVENIO...</option>
                                                        <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Medico a recepcionar') }}:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="text" placeholder="Clave Medico" id="rec_medico_clave" name="rec_medico_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fa-solid fa-user-doctor"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre del Medico" id="rec_medico_nombre" name="rec_medico_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px; "><a href=""><i class="fa-solid fa-user-doctor"></i></a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Especialidad" id="rec_especialidad" name="rec_especialidad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-5 col-sm-5">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <input type="text" placeholder="Observaciones" id="rec_observacion" name="rec_observacion" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <input type="text" placeholder="Referencias" id="rec_referencia" name="rec_referencia" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="date" value="{{ date('Y-m-d') }}" placeholder="Referencias" id="rec_referencia" name="rec_referencia" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-fuchsia collapsed-card">
                        <div class="card-header" style="background-color: #29A689; padding-top: 15px;">
                            <h4 class="card-title">
                                DATOS DEL ESTUDIO
                            </h4>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <label class="col-md-12 col-form-label" >{{ __('Datos del Estudio') }}:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                                </div>
                                                <input type="text" placeholder="Clave del estudio" id="est_clave" name="est_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-notes-medical"></i></div>
                                                </div>
                                                <input type="text" placeholder="Nombre del Estudio" id="est_nombre" name="est_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-3">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Costo del estudio" id="est_costo" name="est_costo" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <a href="" class="btn btn-success">Agregar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12">
                                        <table class="table table-bordered table-responsive-lg">
                                            <thead>
                                                <th>#</th>
                                                <th>Clave</th>
                                                <th>Estudio</th>
                                                <th>Costo</th>
                                                <th>Tipo de muestra</th>
                                                <th>indicaciones</th>
                                                <th>Op</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2QSVI</td>
                                                    <td>QUIMICA SANGUINEA VI</td>
                                                    <td class="text-right">380</td>
                                                    <td>SUERO</td>
                                                    <td></td>
                                                    <td>
                                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>3EGO</td>
                                                    <td>EXAMEN GENERAL DE ORINA</td>
                                                    <td class="text-right">150</td>
                                                    <td>ORINA</td>
                                                    <td>PRIMERA ORINA DE LA MAÑANA</td>
                                                    <td>
                                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>8DRO3</td>
                                                    <td>INVESTIGACION DE DROGAS EN ORINA</td>
                                                    <td class="text-right">0</td>
                                                    <td>ORINA</td>
                                                    <td>NO REQUIERE AYUNO</td>
                                                    <td>
                                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label" for="est_fecha_entrega">{{ __('Fecha de entrega') }}:</label>
                                            <div class="col-md-12" style="display: inline-flex">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-calendar-alt"></i></div>
                                                </div>
                                                <input type="date" value="{{ (new DateTime('tomorrow'))->format('Y-m-d') }}" id="est_fecha_entrega" name="est_fecha_entrega" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label" for="est_descuento_porc">{{ __('Descuento') }}(%):</label>
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-percent"></i></div>
                                                </div>
                                                <input type="number" maxlength="3" size="3" placeholder="Desc(%)" id="est_descuento_porc" name="est_descuento_porc" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label" for="est_descuento_dinero">{{ __('Descuento') }}($):</label>
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="far fa-dollar-sign"></i></div>
                                                </div>
                                                <input type="number" maxlength="3" size="3" placeholder="Desc($)" id="est_descuento_dinero" name="est_descuento_dinero" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-2">
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label" for="est_costo_total">{{ __('Costo Total') }}:</label>
                                            <div class="col-md-12 " style="display: inline-flex;">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-sack-dollar"></i></div>
                                                </div>
                                                <input type="number" placeholder="Costo Total" id="est_costo_total" name="est_costo_total" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 0px 0px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-4">
                                        <div class="form-group row">
                                            <div class="col-md-12" style="margin-top: 35px">
                                                <a href="" class="btn btn-success">Guardar</a>
                                                <a href="" class="btn btn-danger">Cancelar</a>
                                                <a href="" class="btn btn-info">Imprimir</a>
                                            </div>
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