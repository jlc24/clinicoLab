<div class="modal fade" id="modal_crear_medico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_medicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

                <form action="{{ url('medicos') }}" method="POST" class="form-horizontal" id="formulario_crear_medico">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_nombre">{{ __('Nombres') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" placeholder="Nombres" id="med_nombre" name="med_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed()" required>
                                    {{-- <small><span style="color: red;" id="error_med_nombre">(Se requiere Nombre)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_apellido_pat">{{ __('Apellido Paterno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" placeholder="Apellido Paterno" id="med_apellido_pat" name="med_apellido_pat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed()" required>
                                    {{-- <small><span style="color: red;" id="error_med_apellido">(Se requiere Apellido)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_apellido_mat">{{ __('Apellido Materno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <input type="text" placeholder="Apellido Materno" id="med_apellido_mat" name="med_apellido_mat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); UsuarioMed()" >
                                    {{-- <small><span style="color: red;" id="error_med_apellido">(Se requiere Apellido)</span></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="med_ci_nit">C.I.: </label>
                                <div class="col-md-10">
                                    <input type="number" min="0" id="med_ci_nit" name="med_ci_nit" class="form-control form-control-sm" autocomplete="off" placeholder="Carnet C.I."  onchange="PasswordMed()" required>
                                    {{-- <small><span style="color: red;" id="error_med_ci_nit">(Se requiere Nº C.I.)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="med_ci_nit_exp">Exp.:</label>
                                <div class="col-md-10">
                                    <select class="custom-select custom-select-sm" id="med_ci_nit_exp" name="med_ci_nit_exp" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <small><span style="color: red;" id="error_med_ci_nit">(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="med_cod">{{ __('Cod') }}: </label>
                                <div class="col-md-9">
                                    <input type="text" value="MED{{ $countmed+1 }}" id="med_cod" name="med_cod" class="form-control form-control-sm" autocomplete="off" readonly required>
                                    {{-- <small><span style="color: red;" id="error_med_edad">(Se requiere Nº C.I.)</span></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="med_celular">{{ __('Celular') }}: </label>
                                <div class="col-md-8">
                                    <input type="number" min="0" id="med_celular" name="med_celular" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                    <small><span style="color: red; display: none" id="error_med_celular">(Celular no valido)</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="med_genero">{{ __('Género') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="med_genero" name="med_genero" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                    {{-- <small><span style="color: red;" id="error_med_ci_nit">(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="med_especialidad">{{ __('Especialidad') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" placeholder="Especialidad" id="med_especialidad" name="med_especialidad" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    {{-- <small><span style="color: red;" id="error_med_esp">(Se requiere Nº C.I.)</span></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-sm-8">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="med_direccion">{{ __('Dirección') }}:</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Direccion" class="form-control form-control-sm" id="med_direccion" name="med_direccion" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    {{-- <small><span style="color: red;" id="error_cli_direccion" hidden>(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_email">{{ __('Email') }}:</label>
                                <div class="col-md-10 input-group">
                                    <input type="text" placeholder="Correo electrónico" class="form-control form-control-sm" id="med_email" name="med_email" autocomplete="off" required>
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_correo_med" name="generar_correo_med" title="Generar Correo"> 
                                    </div>
                                    {{-- <small><span style="color: red;" id="error_med_email" hidden>(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_usuario">{{ __('Usuario') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Usuario" class="form-control form-control-sm" id="med_usuario" name="med_usuario" autocomplete="off" readonly required>
                                    {{-- <small><span style="color: red;" id="error_med_usuario" hidden>(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="med_password">{{ __('Contraseña') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Contraseña" class="form-control form-control-sm" id="med_password" name="med_password" autocomplete="off" readonly required>
                                    <input type="hidden" value="1" class="form-control form-control-sm" id="med_estado" name="med_estado" autocomplete="off" readonly>
                                    <input type="hidden" value="medico" class="form-control form-control-sm" id="med_rol" name="med_rol" autocomplete="off" readonly>
                                    {{-- <small><span style="color: red;" id="error_med_password" hidden>(Elija una opcion)</span></small> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="btnRegisterMed" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>