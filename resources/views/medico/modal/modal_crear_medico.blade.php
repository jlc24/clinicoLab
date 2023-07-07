<div class="modal fade" id="modal_crear_medico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_medicoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_medicoLabel"><strong>{{ __('Agregar Medico') }}</strong></h1>
                <button type="button" id="btnCloseAddMedic" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <div id="smartwizard_crear_medico">
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                                <div class="num">1</div>
                                {{ __('DATOS PERSONALES') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                                <div class="num">2</div>
                                {{ __('DATOS PERSONALES (Cont.)') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                                <span class="num">3</span>
                                {{ __('DATOS DE CONTACTO') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-4">
                                <span class="num">4</span>
                                {{ __('DATOS DE USUARIO') }}
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_cod">{{ __('Cod') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" id="med_cod" name="med_cod" class="form-control form-control-sm" autocomplete="off" readonly required>
                                        </div>
                                        <label class="col-md-2 col-form-label" for="med_genero">{{ __('Género') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-4">
                                            <select class="custom-select custom-select-sm" id="med_genero" name="med_genero" required>
                                                <option value="" selected="" disabled>SELECCIONAR...</option>
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMENINO">FEMENINO</option>
                                                <option value="OTRO">OTRO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_nombre">{{ __('Nombres') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Nombres" id="med_nombre" name="med_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_apellido_pat">{{ __('Apellidos') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-5">
                                            <input type="text" placeholder="Apellido Paterno" id="med_apellido_pat" name="med_apellido_pat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" required>
                                        </div>
                                        <div class="col-md-4 ml-0 pl-0">
                                            <input type="text" placeholder="Apellido Materno" id="med_apellido_mat" name="med_apellido_mat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_ci_nit">C.I.:</label>
                                        <div class="col-md-4">
                                            <input type="number" min="0" id="med_ci_nit" name="med_ci_nit" class="form-control form-control-sm" autocomplete="off" placeholder="Carnet C.I."  onkeyup="PasswordMed()" required>
                                        </div>
                                        <label class="col-md-1 col-form-label ml-0 pl-0" for="med_ci_nit_exp">Exp.:</label>
                                        <div class="col-md-4">
                                            <select class="custom-select custom-select-sm" id="med_ci_nit_exp" name="med_ci_nit_exp" required>
                                                <option value="" selected="" disabled>SELECCIONAR...</option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_especialidad">{{ __('Especialidad') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Especialidad" id="med_especialidad" name="med_especialidad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_convenio">{{ __('Convenio') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-7">
                                            <input type="number" min="0" step="1" id="med_convenio" name="med_convenio" class="form-control form-control-sm" autocomplete="off" required>
                                        </div>
                                        <label class="col-md-1 col-form-label" for="">%</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_banco">{{ __('Banco') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-9">
                                            {{-- <input type="number" min="0" id="med_banco" name="med_banco" class="form-control form-control-sm" autocomplete="off" required> --}}
                                            <select id="med_banco" class="custom-select custom-select-sm med_banco" name="med_banco">
                                                <option value="" selected disabled>Seleccionar...</option>
                                                @foreach ($bancos as $banco)
                                                    <option value="{{ $banco->nombre }}">{{ $banco->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_cuenta">{{ __('Nº Cuenta') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" min="0" id="med_cuenta" name="med_cuenta" class="form-control form-control-sm" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_qr">{{ __('QR') }}:</label>
                                        <div class="col-md-9" style="display: inline-flex;">
                                            <input type="file" name="med_qr" id="med_qr" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file med_qr" onchange="VerImagen('med_qr', 'img_material')">
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <small><span style="color: red;" id="error_med_nombre">(Tamaño máximo aprox. 2mb)</span></small>
                                        </div>
                                        <div class="col-md-12 text-center mt-2">
                                            <img src="{{ asset('dist/img/default.png') }}" id="img_material" class="img_material" width="80px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_celular">{{ __('Celular') }}:<span class="dato_requerido">*</span></label>
                                        <div class="col-md-9">
                                            <input type="number" min="0" id="med_celular" name="med_celular" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                            <small><span style="color: red; display: none" id="error_med_celular">(Celular no valido)</span></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_direccion">{{ __('Dirección') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Direccion" class="form-control form-control-sm" id="med_direccion" name="med_direccion" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_departamento">{{ __('Departamento') }}:</label>
                                        <div class="col-md-9">
                                            <select class="custom-select custom-select-sm" id="med_departamento" name="med_departamento" >
                                                <option value="" selected="" disabled>SELECCIONAR...</option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_municipio">{{ __('Municipio') }}:</label>
                                        <div class="col-md-9">
                                            <select class="custom-select custom-select-sm" id="med_municipio" name="med_municipio" >
                                                <option value="" selected="" disabled>SELECCIONAR...</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_email">{{ __('Email') }}:</label>
                                        <div class="col-md-8">
                                            <input type="text" placeholder="Correo electrónico" class="form-control form-control-sm" id="med_email" name="med_email" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-1 ml-0 pl-0">
                                            <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                                <input class="form-check-input" type="checkbox" id="generar_correo_med" name="generar_correo_med" title="Generar Correo"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_usuario">{{ __('Usuario') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Usuario" class="form-control form-control-sm" id="med_usuario" name="med_usuario" autocomplete="off" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label" for="med_password">{{ __('Contraseña') }}:</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Contraseña" class="form-control form-control-sm" id="med_password" name="med_password" autocomplete="off" readonly required>
                                            <input type="hidden" value="1" class="form-control form-control-sm" id="med_estado" name="med_estado" autocomplete="off" readonly>
                                            <input type="hidden" value="medico" class="form-control form-control-sm" id="med_rol" name="med_rol" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>