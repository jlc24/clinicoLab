<div class="modal fade" id="modal_actualizar_medico_{{ $medico->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_medico_{{ $medico->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_medico_{{ $medico->id }}Label"><strong>{{ __('Modificar Medico') }}</strong></h1>
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

                <form action="{{ route('medico.update', $medico->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_medico">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_nombre_update">{{ __('Nombres') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" value="{{ $medico->med_nombre }}" id="med_nombre_update" name="med_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_apellido_pat_update">{{ __('Apellido Paterno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" value="{{ $medico->med_apellido_pat }}" id="med_apellido_pat_update" name="med_apellido_pat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_apellido_mat_update">{{ __('Apellido Materno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" value="{{ $medico->med_apellido_mat }}" id="med_apellido_mat_update" name="med_apellido_mat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed(); PasswordMed()" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="med_ci_nit_update">C.I.: </label>
                                <div class="col-md-9">
                                    <input type="number" value="{{ $medico->med_ci_nit }}" min="0" id="med_ci_nit_update" name="med_ci_nit_update" class="form-control form-control-sm" autocomplete="off" placeholder="Carnet C.I."  onkeyup="PasswordMed()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="med_ci_nit_exp_update">Exp.:</label>
                                <div class="col-md-9">
                                    <select class="custom-select custom-select-sm" id="med_ci_nit_exp_update" name="med_ci_nit_exp_update" required>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}"
                                                @if($departamento->nombre == $medico->med_exp_ci)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="med_cod_update">{{ __('Cod') }}: </label>
                                <div class="col-md-9">
                                    <input type="text" value="{{ $medico->med_cod }}" id="med_cod_update" name="med_cod_update" class="form-control form-control-sm" autocomplete="off" readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="med_celular_update">{{ __('Celular') }}: </label>
                                <div class="col-md-8">
                                    <input type="number" value="{{ $medico->med_celular }}" min="0" id="med_celular_update" name="med_celular_update" class="form-control form-control-sm" autocomplete="off" required>
                                    <small><span style="color: red; display: none" id="error_med_celular_update">(Celular no valido)</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label mr-0 pr-0" for="med_genero_update">{{ __('Género') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="med_genero_update" name="med_genero_update" required>
                                        @if($medico->med_genero == 'MASCULINO')
                                            <option value="{{ $medico->med_genero }}" selected>{{ $medico->med_genero }}</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="OTRO">OTRO</option>
                                        @else
                                            <option value="{{ $medico->med_genero }}" selected>{{ $medico->med_genero }}</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="OTRO">OTRO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-5">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="med_especialidad_update">{{ __('Especialidad') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $medico->med_especialidad }}" id="med_especialidad_update" name="med_especialidad_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_direccion_update">{{ __('Dirección') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $medico->med_direccion }}" class="form-control form-control-sm" id="med_direccion_update" name="med_direccion_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_departamento_update">{{ __('Departamento') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_departamento_update" name="cli_departamento_update" required>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                @if($departamento->id == $medico->dep_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_municipio_update">{{ __('Municipio') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_municipio_update" name="cli_municipio_update" required>
                                        @foreach ($municipios as $municipio)
                                            <option value="{{ $municipio->id }}"
                                                @if($municipio->id == $medico->mun_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $municipio->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_email_update">{{ __('Email') }}:</label>
                                <div class="col-md-10 input-group">
                                    @if(Auth::user()->rol == 'admin')
                                        <input type="text" value="{{ $medico->med_correo }}" class="form-control form-control-sm" id="med_email_update" name="med_email_update" autocomplete="off" readonly>
                                        <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                            <input class="form-check-input" type="checkbox" id="generar_correo_med_update" name="generar_correo_med_update" title="Generar Correo" disabled> 
                                        </div>
                                    @else
                                        <input type="password" value="******************************" class="form-control form-control-sm" id="med_email_update" name="med_email_update" autocomplete="off" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_usuario_update">{{ __('Usuario') }}:</label>
                                <div class="col-md-12">
                                    @if(Auth::user()->rol == 'admin')
                                        <input type="text" value="{{ $medico->med_usuario }}" class="form-control form-control-sm" id="med_usuario_update" name="med_usuario_update" autocomplete="off" readonly required>
                                    @else
                                        <input type="password" value="***************" class="form-control form-control-sm" id="med_usuario_update" name="med_usuario_update" autocomplete="off" readonly required>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_password_update">{{ __('Contraseña') }}:</label>
                                <div class="col-md-12">
                                    @if(Auth::user()->rol == 'admin')
                                        <input type="text" value="{{ $medico->med_password }}" class="form-control form-control-sm" id="med_password_update" name="med_password_update" autocomplete="off" readonly required>
                                    @else
                                        <input type="password" value="***************" class="form-control form-control-sm" id="med_password_update" name="med_password_update" autocomplete="off" readonly required>
                                    @endif
                                    <input type="hidden" value="1" class="form-control form-control-sm" id="med_estado_update" name="med_estado_update" autocomplete="off" readonly>
                                    <input type="hidden" value="medico" class="form-control form-control-sm" id="med_rol_update" name="med_rol_update" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnUpdateMed" class="btn btn-success">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>