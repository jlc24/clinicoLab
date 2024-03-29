<div class="modal fade" id="modal_crear_estudio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_estudioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_estudioLabel"><strong>{{ __('Agregar Estudio o Análisis') }}</strong></h1>
                <button type="button" id="btnCloseAddEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_crear_estudio">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_cod">{{ __('Clave') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-5" style="display: inline-flex;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px;"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" placeholder="Clave Estudio" id="est_cod" name="est_cod" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_clave_est" name="generar_clave_est" title="Generar Clave"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_nombre">{{ __('Nombre Estudio') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" id="est_nombre" name="est_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Estudio" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_descripcion">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="est_descripcion" id="est_descripcion" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_grupo">{{ __('Grupo') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-6">
                                    <select class="custom-select custom-select-sm" id="est_grupo" name="est_grupo" onchange="obligado($(this))" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a data-toggle="modal" data-target="#modal_crear_grupo" class="btn btn-sm btn-outline-info btnAddGrupo" title="Nuevo Grupo"><i class="fas fa-th"> +</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_subgrupo">{{ __('Sub - Grupo') }}:</label>
                                <div class="col-md-6">
                                    <select class="custom-select custom-select-sm" id="est_subgrupo" name="est_subgrupo" onchange="opcional($(this))" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a data-toggle="modal" data-target="#modal_crear_subgrupo" class="btn btn-sm btn-outline-info btnAddSubGrupo" title="Nuevo SubGrupo"><i class="fas fa-th"> +</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_muestra">{{ __('Tipo de Muestra') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-6">
                                    <select class="custom-select custom-select-sm" id="est_muestra" name="est_muestra" onchange="obligado($(this))" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a data-toggle="modal" data-target="#modal_crear_muestra" class="btn btn-sm btn-outline-info btnAddMuestra" title="Nuevo Muestra"><i class="fas fa-th"> +</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_recipiente">{{ __('Recipiente') }}: </label>
                                <div class="col-md-6">
                                    <select class="custom-select custom-select-sm est_recipiente" id="est_recipiente" name="est_recipiente" onchange="opcional($(this))" >
                                        <option value="" selected="">SELECCIONAR...</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a data-toggle="modal" data-target="#modal_crear_recipiente" class="btn btn-sm btn-outline-info btnAddRecipiente" title="Nuevo Recipiente"><i class="fas fa-th"> +</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_indicaciones">{{ __('Indicaciones') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-6">
                                    <select class="custom-select custom-select-sm est_indicaciones" id="est_indicaciones" name="est_indicaciones" onchange="obligado($(this))">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <a data-toggle="modal" data-target="#modal_crear_indicacion" class="btn btn-sm btn-outline-info btnAddIndicacion" title="Nuevo Indicacion"><i class="fas fa-th"> +</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_precio">{{ __('Precio') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-5">
                                    <input type="number" min="0" step="0.01" value="0.00" id="est_precio" name="est_precio" class="form-control form-control-sm" autocomplete="off" placeholder="Precio Estudio" onkeyup="obligado($(this))" onchange="obligado($(this))" required>
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select custom-select-sm" id="est_moneda" name="est_moneda" onchange="obligado($(this))" required>
                                        <option value="Bs" selected>Bs</option>
                                        <option value="$">$</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnRegisterEst" class="btn btn-success">{{ __('Registrar') }}</button>
            </div>
        </div>
    </div>
</div>