<div class="modal fade" id="modal_actualizar_empresa_{{ $empresa->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_empresa_{{ $empresa->id }}Label" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_empresa_{{ $empresa->id }}Label"><strong>{{ __('Modificar Empresa') }}</strong></h1>
                <button type="button" id="btnCloseUpEmpresa" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('empresas/'.$empresa->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_empresa">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-sm-6" >
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_cod_update">Cod: </label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" value="{{ $empresa->emp_cod }}" id="emp_cod_update" name="emp_cod_update" class="form-control form-control-sm" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_nit_update">{{ __('NIT') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $empresa->emp_nit }}" id="emp_nit_update" name="emp_nit_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_nombre_update">{{ __('Nombre de la Empresa') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $empresa->emp_nombre }}" id="emp_nombre_update" name="emp_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_direccion_update">{{ __('Dirección') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $empresa->emp_direccion }}" class="form-control form-control-sm" id="emp_direccion_update" name="emp_direccion_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_departamento_update">{{ __('Departamento') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_departamento_update" name="cli_departamento_update" >
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}"
                                                @if($departamento->id == $empresa->dep_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_municipio_update">{{ __('Municipio') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_municipio_update" name="cli_municipio_update" >
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($municipios as $municipio)
                                            <option value="{{ $municipio->id }}"
                                                @if($municipio->id == $empresa->mun_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $municipio->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnRegisterClient" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
