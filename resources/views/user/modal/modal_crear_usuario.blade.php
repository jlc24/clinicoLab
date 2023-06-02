<div class="modal fade" id="modal_crear_usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_usuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_usuarioLabel"><strong>{{ __('Agregar Usuario') }}</strong></h1>
                <button type="button" id="btnCloseAddUsuario" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div id="smartwizard_crear_usuario">
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                                <div class="num">1</div>
                                {{ __('DATOS PERSONALES') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                                <span class="num">2</span>
                                {{ __('DATOS DE CONTACTO') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                                <span class="num">3</span>
                                {{ __('DATOS DE USUARIO') }}
                            </a>
                        </li>
                    </ul>
                    <form class="form-horizontal" id="formulario_crear_usuario">
                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_cod">{{ __('Cod') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" value="USER{{ $countuser+1 }}" id="usuario_cod" name="usuario_cod" class="form-control form-control-sm" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_nombre">{{ __('Nombres') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Nombres" id="usuario_nombre" name="usuario_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario(); Password()" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_apellido_pat">{{ __('Apellidos') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-5">
                                                <input type="text" placeholder="Apellido Paterno" id="usuario_apellido_pat" name="usuario_apellido_pat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario(); Password()" required>
                                            </div>
                                            <div class="col-md-4 ml-0 pl-0">
                                                <input type="text" placeholder="Apellido Materno" id="usuario_apellido_mat" name="usuario_apellido_mat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario(); Password()">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_ci_nit">C.I.:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-4">
                                                <input type="number" min="0" id="usuario_ci_nit" name="usuario_ci_nit" class="form-control form-control-sm" autocomplete="off" placeholder="Carnet C.I." onkeyup="Password()" required>
                                            </div>
                                            <label class="col-md-1 col-form-label ml-0 pl-0" for="usuario_ci_nit_exp">Exp.:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-4">
                                                <select class="custom-select custom-select-sm" id="usuario_ci_nit_exp" name="usuario_ci_nit_exp" required>
                                                    <option value="" selected="" disabled>SELECCIONAR...</option>
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_fec_nac">{{ __('Fecha Nac.') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-4">
                                                <input type="date" id="usuario_fec_nac" name="usuario_fec_nac" class="form-control form-control-sm" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_genero">{{ __('Género') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <select class="custom-select custom-select-sm" id="usuario_genero" name="usuario_genero" required>
                                                    <option value="" selected="" disabled>SELECCIONAR...</option>
                                                    <option value="MASCULINO">MASCULINO</option>
                                                    <option value="FEMENINO">FEMENINO</option>
                                                    <option value="OTRO">OTRO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_celular">{{ __('Celular') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="number" min="0" id="usuario_celular" name="usuario_celular" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                                <small><span style="color: red; display: none" id="error_usuario_celular">(Celular no valido)</span></small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_direccion">{{ __('Dirección') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Direccion" class="form-control form-control-sm" id="usuario_direccion" name="usuario_direccion" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_departamento">{{ __('Departamento') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <select class="custom-select custom-select-sm" id="usuario_departamento" name="usuario_departamento" >
                                                    <option value="" selected="" disabled>SELECCIONAR...</option>
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_municipio">{{ __('Municipio') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <select class="custom-select custom-select-sm" id="usuario_municipio" name="usuario_municipio" >
                                                    <option value="" selected="" disabled>SELECCIONAR...</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_email">{{ __('Email') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" placeholder="Correo electrónico" class="form-control form-control-sm" id="usuario_email" name="usuario_email" autocomplete="off" required>
                                            </div>
                                            <div class="col-md-1 ml-0 pl-0">
                                                <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                                    <input class="form-check-input" type="checkbox" id="generar_correo_usuario" name="generar_correo_usuario" title="Generar Correo"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_usuario">{{ __('Usuario') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Usuario" class="form-control form-control-sm" id="usuario_usuario" name="usuario_usuario" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_password">{{ __('Contraseña') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Contraseña" class="form-control form-control-sm" id="usuario_password" name="usuario_password" autocomplete="off" readonly>
                                                <input type="hidden" value="0" class="form-control form-control-sm" id="usuario_estado" name="usuario_estado" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label" for="usuario_rol">{{ __('Rol') }}:<span class="dato_requerido">*</span></label>
                                            <div class="col-md-9">
                                                <select class="custom-select custom-select-sm" id="usuario_rol" name="usuario_rol" >
                                                    <option value="usuario" selected>USUARIO</option>
                                                    <option value="admin">ADMINISTRADOR</option>
                                                </select>
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
    </div>
</div>
