@extends('layouts.app')

@section('contenido')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Recepción') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Inicio') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Captura') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Recepción') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" id="RecepcionEstudio">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-sm-12">
                    <form id="form_recepcion_factura">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                {{ __('DATOS DE RECEPCION') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-1 col-sm-12">
                                    <label class="col-form-label" for="rec_factura" >{{ __('Caja') }}:</label>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px; width: 35px;"><strong>Nº</strong></div>
                                            </div>
                                            <input type="number" value="{{ $caja->id }}" name="rec_caja" id="rec_caja" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1 col-sm-12">
                                    <label class="col-form-label" for="rec_factura" >{{ __('Factura') }}:</label>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px; width: 35px;"><strong>Nº</strong></div>
                                            </div>
                                            <input type="number"  id="rec_factura" name="rec_factura" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12"></div>
                                <div class="col-xl-2 col-sm-12">
                                    <label class="col-form-label" for="rec_fecha">{{ __('Fecha Recepcion') }}:</label>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px; width: 35px;"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="date" value="{{ date('Y-m-d') }}" placeholder="Fecha" id="rec_fecha" name="rec_fecha" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row" id="datosPaciente">
                                <div class="col-xl-12 col-sm-12">
                                    <label class="col-md-12 col-form-label" ><i class="fas fa-user"></i> {{ __('Datos del Paciente a recepcionar') }}:<span class="dato_requerido">*</span></label>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" placeholder="Clave" id="rec_paciente_clave" name="rec_paciente_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <input type="text" placeholder="Nombre Paciente" id="rec_paciente_nombre" name="rec_paciente_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="padding-left: 5px; border-radius: 0px 5px 5px 0px; height: 31px; width: 40px"><a href="#" data-toggle="modal" data-target="#modal_crear_cliente" title="Nuevo paciente" style="color: #000" class="btnAddPaciente"><i class="fas fa-user">+</i></a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Genero" id="rec_genero" name="rec_genero" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Edad" id="rec_edad" name="rec_edad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Celular" id="rec_celular" name="rec_celular" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-xl-12 col-sm-12 mb-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="checkEmpresa" id="checkEmpresa" title="Habilitar Empresa">
                                        <label class="form-check-label" for="checkEmpresa"><i class="fas fa-building"></i><strong>{{ __(' Datos de la Empresa a recepcionar') }}: </strong></label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" placeholder="Clave" id="rec_empresa_clave" name="rec_empresa_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 5px 5px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-9 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <input type="text" placeholder="Nombre de la Empresa" id="rec_empresa_nombre" name="rec_empresa_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="padding-left: 5px; border-radius: 0px 5px 5px 0px; height: 31px; width: 40px"><a href="#" data-toggle="modal" data-target="#modal_crear_empresa" title="Nueva Empresa" id="rec_empresa_add" style="color: #000; pointer-events: none; opacity: 0.5;"><i class="fas fa-building">+</i></a> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-xl-6 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Convenio" id="rec_emp_convenio" name="rec_emp_convenio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 5px 5px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 mb-2">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="checkMedico" id="checkMedico" title="Habilitar Medico">
                                        <label class="form-check-label" for="checkMedico"><i class="fa-solid fa-user-doctor"></i><strong>{{ __(' Datos del Medico a recepcionar') }}: (Opcional)</strong></label>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" placeholder="Clave" id="rec_medico_clave" name="rec_medico_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 5px 5px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <input type="text" placeholder="Nombre del Medico" id="rec_medico_nombre" name="rec_medico_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px; " onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="padding-left: 5px; border-radius: 0px 5px 5px 0px; height: 31px; width: 40px"><a href="#" data-toggle="modal" data-target="#modal_crear_medico" title="Nuevo Medico" id="rec_medico_add" style="color: #000; pointer-events: none; opacity: 0.5;"><i class="fa-solid fa-user-doctor">+</i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Especialidad" id="rec_especialidad" name="rec_especialidad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" placeholder="Observaciones" id="rec_observacion" name="rec_observacion" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" placeholder="Referencias" id="rec_referencia" name="rec_referencia" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header" style="padding-top: 15px;">
                            <h4 class="card-title">
                                DATOS DEL ESTUDIO
                            </h4>
                            <div class="card-tools">
                                <button type="button" id="CargarRecepcion" class="btn btn-tool" title="Cargar tabla">
                                  <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <label class="col-md-12 col-form-label" >{{ __('Recepcionar estudios') }}:</label>
                                </div>
                            </div>
                            <div class="row" id="RecepcionPerfil" hidden>
                                <div class="col-xl-3 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                            </div>
                                            <input type="text" placeholder="Clave Perfil" id="rec_perfil_clave" name="rec_perfil_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <div class="input-group-prepend" >
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-notes-medical"></i></div>
                                            </div>
                                            <input type="text" placeholder="Nombre del Perfil" id="rec_perfil_nombre" name="rec_perfil_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Precio" id="rec_perfil_precio" name="rec_perfil_precio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="rec_estado" id="rec_estado" value="Pendiente">
                                            <a href="javascript:void(0);" id="btnAddPerfil" class="btn btn-success">Agregar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="RecepcionarEstudio">
                                <div class="col-xl-3 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-keyboard"></i></div>
                                            </div>
                                            <input type="text" placeholder="Clave estudio" id="rec_est_clave" name="rec_est_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <div class="input-group-prepend" >
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-notes-medical"></i></div>
                                            </div>
                                            <input type="text" placeholder="Nombre del Estudio" id="rec_est_nombre" name="rec_est_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Precio" id="rec_est_precio" name="rec_est_precio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="rec_estado" id="rec_estado" value="Pendiente">
                                            <a href="javascript:void(0);" id="btnAddRecepcion" class="btn btn-success">Agregar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @include('recepcion.tablas.tabla_recepcion')
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-3 col-sm-12">
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
                                
                                <div class="col-xl-3 col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-12 col-form-label" for="est_precio_total">{{ __('Precio Total') }}:</label>
                                        <div class="col-md-12 " style="display: inline-flex;">
                                            <div class="input-group-prepend" >
                                                <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px;"><i class="fas fa-sack-dollar"></i></div>
                                            </div>
                                            <input type="number" placeholder="Total" id="est_precio_total" name="est_precio_total" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px; " onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="margin-top: 35px">
                                            <input type="hidden" id="rec_est_id" name="rec_est_id">
                                            <input type="hidden" name="rec_paciente_id" id="rec_paciente_id">
                                            <input type="hidden" name="rec_medico_id" id="rec_medico_id">
                                            <input type="hidden" name="rec_empresa_id" id="rec_empresa_id">
                                            <a href="#" id="btnUpdateRec" class="btn btn-outline-info" >Recepcionar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-12 text-right">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="margin-top: 35px">
                                            <a href="#" id="btnEnviarCotizacion" class="btn btn-outline-success" title="Enviar Cotizacion"><i class="fab fa-whatsapp fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @if (isset($mensaje))
        <div class="alert alert-success">{{ $mensaje }}</div>
    @endif
    @include('cliente.modal.modal_crear_cliente')
    @include('medico.modal.modal_crear_medico')
    @include('empresa.modal.modal_crear_empresa')
    @include('recepcion.modal.modal_recepcion_factura')
    @include('recepcion.modal.modal_enviar_cotizacion')
    @include('cliente.modal.modal_ver_resultadopdf')
@endsection

@section('funciones')
    @include('recepcion.funciones.funciones_recepcion')
@endsection