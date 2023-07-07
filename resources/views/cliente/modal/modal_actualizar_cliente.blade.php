<div class="modal fade" id="modal_actualizar_cliente_{{ $cliente->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_cliente_{{ $cliente->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_cliente_{{ $cliente->id }}Label"><strong>{{ __('Modificar datos del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseUpClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <form action="{{ route('cliente.update', $cliente->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_cliente">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_nombre_update">{{ __('Nombres') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="hidden" value="{{ $cliente->id }}" name="cli_id_update" id="cli_id_update">
                                    <input type="text" value="{{ $cliente->cli_nombre }}" id="cli_nombre_update" name="cli_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_apellido_pat_update">{{ __('Apellido Paterno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $cliente->cli_apellido_pat }}" id="cli_apellido_pat_update" name="cli_apellido_pat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_apellido_mat_update">{{ __('Apellido Materno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $cliente->cli_apellido_mat }}" id="cli_apellido_mat_update" name="cli_apellido_mat_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="cli_ci_nit_update">C.I.: </label>
                                <div class="col-md-9">
                                    <input type="number" min="0" value="{{ $cliente->cli_ci_nit }}" id="cli_ci_nit_update" name="cli_ci_nit_update" class="form-control form-control-sm" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="cli_ci_nit_exp_update">Exp.:</label>
                                <div class="col-md-9">
                                    <select class="custom-select custom-select-sm" id="cli_ci_nit_exp_update" name="cli_ci_nit_exp_update" >
                                        <option value="">Seleccionar...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}"
                                                @if($departamento->nombre == $cliente->cli_exp_ci)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label" for="cli_fec_nac_update">{{ __('Fecha Nac.') }}: </label>
                                <div class="col-md-7">
                                    <input type="date" value="{{ $cliente->cli_fec_nac }}" id="cli_fec_nac_update" name="cli_fec_nac_update" class="form-control form-control-sm" autocomplete="off" onchange="CalcularEdad()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cli_cod_update">{{ __('Cod') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $cliente->cli_cod }}" id="cli_cod_update" name="cli_cod_update" class="form-control form-control-sm" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 p-0 col-form-label" for="cli_celular_update">{{ __('Celular') }}: </label>
                                <div class="col-md-8">
                                    <input type="number" min="0" value="{{ $cliente->cli_celular }}" id="cli_celular_update" name="cli_celular_update" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                    <small><span style="color: red; display: none" id="error_cli_celular_update">(Celular no valido)</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 p-0 col-form-label" for="cli_genero_update">{{ __('Género') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="cli_genero_update" name="cli_genero_update" required>
                                        
                                        @if($cliente->cli_genero == 'MASCULINO')
                                            <option value="{{ $cliente->cli_genero }}" selected>{{ $cliente->cli_genero }}</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="OTRO">OTRO</option>
                                        @elseif($cliente->cli_genero == 'FEMENINO')
                                            <option value="{{ $cliente->cli_genero }}" selected>{{ $cliente->cli_genero }}</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="OTRO">OTRO</option>
                                        @else
                                            <option value="{{ $cliente->cli_genero }}" selected>{{ $cliente->cli_genero }}</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cli_edad_update">{{ __('Edad') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $cliente->cli_edad }} años" id="cli_edad_update" name="cli_edad_update" class="form-control form-control-sm" autocomplete="off"  readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_direccion_update">{{ __('Dirección') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_direccion }}" class="form-control form-control-sm" id="cli_direccion_update" name="cli_direccion_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_departamento_update">{{ __('Departamento') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_departamento_update" name="cli_departamento_update">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                @if($departamento->id == $cliente->dep_id)
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
                                    <select class="custom-select custom-select-sm" id="cli_municipio_update" name="cli_municipio_update">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($municipios as $municipio)
                                            <option value="{{ $municipio->id }}"
                                                @if($municipio->id == $cliente->mun_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $municipio->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" hidden>
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_email_update">{{ __('Email') }}:</label>
                                <div class="col-md-10 input-group">
                                    <input type="text" value="{{ $cliente->cli_correo }}" class="form-control form-control-sm" id="cli_email_update" name="cli_email_update" autocomplete="off" readonly>
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_correo_cli_update" name="generar_correo_cli_update" title="Generar Correo" disabled> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_usuario_update">{{ __('Usuario') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_usuario }}" class="form-control form-control-sm" id="cli_usuario_update" name="cli_usuario_update" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_password_update">{{ __('Contraseña') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_password }} {{ $cliente->med_id }}" class="form-control form-control-sm" id="cli_password_update" name="cli_password_update" autocomplete="off" readonly>
                                    <input type="hidden" value="1" class="form-control form-control-sm" id="cli_estado_update" name="cli_estado_update" autocomplete="off" readonly>
                                    <input type="hidden" value="cliente" class="form-control form-control-sm" id="cli_rol_update" name="cli_rol_update" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_medico_update">{{ __('Medico') }}:</label>
                                <div class="col-md-10 input-group">
                                    <select class="custom-select custom-select-sm" id="cli_medico_update" name="cli_medico_update">
                                        <option value="" selected>Seleccionar...</option>
                                        @foreach ($medicos as $medico)
                                            <option value="{{ $medico->id }}"
                                                @if($medico->id == $cliente->med_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $medico->med_nombre }} {{ $medico->med_apellido_pat }} {{ $medico->med_apellido_mat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="btnUpdateClient" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>