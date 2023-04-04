<div class="modal fade" id="modal_update_cliente_{{ $cliente->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_update_clienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_update_clienteLabel"><strong>{{ __('Modificar datos del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseAddClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <form action="{{ url('clientes/'.$cliente->user_id) }}" method="POST" class="form-horizontal" id="formulario_modificar_cliente">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_nombre">{{ __('Nombres') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $cliente->cli_nombre }}" placeholder="Nombres" id="cli_nombre" name="cli_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_apellido_pat">{{ __('Apellido Paterno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $cliente->cli_apellido_pat }}" placeholder="Apellido Paterno" id="cli_apellido_pat" name="cli_apellido_pat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_apellido_mat">{{ __('Apellido Materno') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $cliente->cli_apellido_mat }}" placeholder="Apellido Materno" id="cli_apellido_mat" name="cli_apellido_mat" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="cli_ci_nit">C.I.: </label>
                                <div class="col-md-9">
                                    <input type="number" min="0" value="{{ $cliente->cli_ci_nit }}" id="cli_ci_nit" name="cli_ci_nit" class="form-control form-control-sm" autocomplete="off" placeholder="Carnet C.I."  onchange="Password()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="cli_ci_nit_exp">Exp.:</label>
                                <div class="col-md-9">
                                    <select class="custom-select custom-select-sm" id="cli_ci_nit_exp" name="cli_ci_nit_exp" required>
                                        
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                        @endforeach
                                        <option value="{{ $cliente->cli_exp_ci }}" selected>{{ $cliente->cli_exp_ci }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4" >
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label" for="cli_fec_nac">{{ __('Fecha Nac.') }}: </label>
                                <div class="col-md-7">
                                    <input type="date" value="{{ $cliente->cli_fec_nac }}" id="cli_fec_nac" name="cli_fec_nac" class="form-control form-control-sm" autocomplete="off" onchange="CalcularEdad()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cli_cod">{{ __('Cod') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $cliente->cli_cod }}" id="cli_cod" name="cli_cod" class="form-control form-control-sm" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 p-0 col-form-label" for="cli_celular">{{ __('Celular') }}: </label>
                                <div class="col-md-8">
                                    <input type="number" min="0" value="{{ $cliente->cli_celular }}" id="cli_celular" name="cli_celular" class="form-control form-control-sm" autocomplete="off" placeholder="Celular" required>
                                    <small><span style="color: red; display: none" id="error_cli_celular">(Celular no valido)</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 p-0 col-form-label" for="cli_genero">{{ __('Género') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="cli_genero" name="cli_genero" required>
                                        <option value="{{ $cliente->cli_genero }}" selected >{{ $cliente->cli_genero }}</option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMENINO">FEMENINO</option>
                                        <option value="OTRO">OTRO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="cli_edad">{{ __('Edad') }}: </label>
                                <div class="col-md-8">
                                    <input type="text"  id="cli_edad" name="cli_edad" class="form-control form-control-sm" autocomplete="off"  readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_direccion">{{ __('Dirección') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_direccion }}" placeholder="Direccion" class="form-control form-control-sm" id="cli_direccion" name="cli_direccion" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_departamento">{{ __('Departamento') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_departamento" name="cli_departamento" required onchange="municipio()">
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}" 
                                                @if ($departamento->id == $cliente->dep_id)
                                                    {{ 'selected' }}
                                                @endif>
                                                {{ $departamento->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_municipio">{{ __('Municipio') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_municipio" name="cli_municipio" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" 
                                                @if ($municipio->id == $cliente->mun_id)
                                                    {{ 'selected' }}
                                                @endif>
                                                {{ $municipio->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_email">{{ __('Email') }}:</label>
                                <div class="col-md-10 input-group">
                                    <input type="text" value="{{ $cliente->cli_correo }}" placeholder="Correo electrónico" class="form-control form-control-sm" id="cli_email" name="cli_email" autocomplete="off" required>
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_correo_cli" name="generar_correo_cli" title="Generar Correo"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_usuario">{{ __('Usuario') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_usuario }}" placeholder="Usuario" class="form-control form-control-sm" id="cli_usuario" name="cli_usuario" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_password">{{ __('Contraseña') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $cliente->cli_password }}" placeholder="Contraseña" class="form-control form-control-sm" id="cli_password" name="cli_password" autocomplete="off" readonly>
                                    <input type="hidden" value="1" class="form-control form-control-sm" id="cli_estado" name="cli_estado" autocomplete="off" readonly>
                                    <input type="hidden" value="cliente" class="form-control form-control-sm" id="cli_rol" name="cli_rol" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" id="btnRegisterClient" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>