<div class="modal fade" id="modal_actualizar_usuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_usuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_usuarioLabel"><strong>{{ __('Modificar datos del Usuario') }}</strong></h1>
                <button type="button" id="btnCloseUpUsuario" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="row">
                    <div class="col-xl-4 col-sm-4">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_nombre_update">{{ __('Nombres') }}:</label>
                            <div class="col-md-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="hidden" value="" name="usuario_id_update" id="usuario_id_update">
                                <input type="text" id="usuario_nombre_update" name="usuario_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioUp(); PasswordUp(); generarCorreoUp()" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_apellido_pat_update">{{ __('Apellido Paterno') }}:</label>
                            <div class="col-md-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" id="usuario_apellido_pat_update" name="usuario_apellido_pat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioUp(); PasswordUp(); generarCorreoUp()" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_apellido_mat_update">{{ __('Apellido Materno') }}:</label>
                            <div class="col-md-12 input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                </div>
                                <input type="text" id="usuario_apellido_mat_update" name="usuario_apellido_mat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioUp(); PasswordUp(); generarCorreoUp()" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-sm-4" >
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="usuario_ci_nit_update">C.I.: </label>
                            <div class="col-md-9">
                                <input type="number" min="0" id="usuario_ci_nit_update" name="usuario_ci_nit_update" class="form-control form-control-sm" autocomplete="off"  onkeyup="PasswordUp(); generarCorreoUp()" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="usuario_ci_nit_exp_update">Exp.:</label>
                            <div class="col-md-9">
                                <select class="custom-select custom-select-sm" id="usuario_ci_nit_exp_update" name="usuario_ci_nit_exp_update" required>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4" >
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label" for="usuario_fec_nac_update">{{ __('Fecha Nac.') }}: </label>
                            <div class="col-md-7">
                                <input type="date" id="usuario_fec_nac_update" name="usuario_fec_nac_update" class="form-control form-control-sm" autocomplete="off" onchange="CalcularEdad()" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="usuario_cod_update">{{ __('Cod') }}: </label>
                            <div class="col-md-8">
                                <input type="text" id="usuario_cod_update" name="usuario_cod_update" class="form-control form-control-sm" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-4 p-0 col-form-label" for="usuario_celular_update">{{ __('Celular') }}: </label>
                            <div class="col-md-8">
                                <input type="number" min="0" id="usuario_celular_update" name="usuario_celular_update" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                <small><span style="color: red; display: none" id="error_usuario_celular_update">(Celular no valido)</span></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-4 p-0 col-form-label" for="usuario_genero_update">{{ __('Género') }}: </label>
                            <div class="col-md-8">
                                <select class="custom-select custom-select-sm" id="usuario_genero_update" name="usuario_genero_update" required>
                                    <option value="FEMENINO" selected>FEMENINO</option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="OTRO">OTRO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="usuario_edad_update">{{ __('Edad') }}: </label>
                            <div class="col-md-8">
                                <input type="text" id="usuario_edad_update" name="usuario_edad_update" class="form-control form-control-sm" autocomplete="off"  readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_direccion_update">{{ __('Dirección') }}:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-sm" id="usuario_direccion_update" name="usuario_direccion_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_departamento_update">{{ __('Departamento') }}:</label>
                            <div class="col-md-12">
                                <select class="custom-select custom-select-sm" id="usuario_departamento_update" name="usuario_departamento_update" required>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_municipio_update">{{ __('Municipio') }}:</label>
                            <div class="col-md-12">
                                <select class="custom-select custom-select-sm" id="usuario_municipio_update" name="usuario_municipio_update" required>
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio->nombre }}">{{ $municipio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_email_update">{{ __('Email') }}:</label>
                            <div class="col-md-10 input-group">
                                <input type="text" class="form-control form-control-sm" id="usuario_email_update" name="usuario_email_update" autocomplete="off" readonly>
                                <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                    <input class="form-check-input" type="checkbox" id="generar_correo_usuario_update" name="generar_correo_usuario_update" title="Generar Correo" disabled> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_usuario_update">{{ __('Usuario') }}:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-sm" id="usuario_usuario_update" name="usuario_usuario_update" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_password_update">{{ __('Contraseña') }}:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-sm" id="usuario_password_update" name="usuario_password_update" autocomplete="off" readonly>
                                <input type="hidden" value="1" class="form-control form-control-sm" id="usuario_estado_update" name="usuario_estado_update" autocomplete="off" readonly>
                                <input type="hidden" value="usuarioente" class="form-control form-control-sm" id="usuario_rol_update" name="usuario_rol_update" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="usuario_rol_update">{{ __('Rol') }}:</label>
                            <div class="col-md-10 input-group">
                                <select class="custom-select custom-select-sm" id="usuario_rol_update" name="usuario_rol_update">
                                    <option value="" selected>Seleccionar...</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button id="btnUpdateClient" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </div>
</div>