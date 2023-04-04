<div class="modal fade" id="modal_crear_empresa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_empresaLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_empresaLabel"><strong>{{ __('Agregar Empresa') }}</strong></h1>
                <button type="button" id="btnCloseAddEmp" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('empresas') }}" method="POST" class="form-horizontal" id="formulario_crear_empresa">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-sm-6" >
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_cod">Cod: </label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" value="EMP{{ $countemp+1 }}" id="emp_cod" name="emp_cod" class="form-control form-control-sm" autocomplete="off" placeholder="Codigo" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_nit">{{ __('NIT') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" placeholder="NIT" id="emp_nit" name="emp_nit" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_nombre">{{ __('Nombre de la Empresa') }}:</label>
                                <div class="col-md-12 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                    </div>
                                    <input type="text" placeholder="Nombre Empresa" id="emp_nombre" name="emp_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); Usuario()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="emp_direccion">{{ __('Dirección') }}:</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Direccion" class="form-control form-control-sm" id="emp_direccion" name="emp_direccion" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_departamento">{{ __('Departamento') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_departamento" name="cli_departamento" >
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label" for="cli_municipio">{{ __('Municipio') }}:</label>
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" id="cli_municipio" name="cli_municipio" >
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
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
