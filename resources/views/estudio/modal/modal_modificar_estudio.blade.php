<div class="modal fade" id="modal_editar_estudio" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_editar_estudioLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_editar_estudioLabel"><strong>{{ __('Modificar Estudio o Análisis') }}</strong></h1>
                <button type="button" id="btnCloseUpEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_actualizar_estudio">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_cod_update">{{ __('Clave') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-5" style="display: inline-flex;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px;"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" id="est_cod_update" name="est_cod_update" class="form-control form-control-sm est_cod_update" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                    <input type="hidden" name="est_id_update" id="est_id_update" class="est_id_update">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_clave_est_update" name="generar_clave_est_update" title="Generar Clave" readonly> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_nombre_update">{{ __('Nombre Estudio') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" id="est_nombre_update" name="est_nombre_update" class="form-control form-control-sm est_nombre_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_descripcion_update">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm est_descripcion_update" name="est_descripcion_update" id="est_descripcion_update" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_grupos_update">{{ __('Grupo') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm est_grupos_update" id="est_grupos_update" name="est_grupos_update" onchange="obligado($(this))" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_subgrupos_update">{{ __('Sub - Grupo') }}:</label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm est_subgrupos_update" id="est_subgrupos_update" name="est_subgrupos_update" onchange="opcional($(this))">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        @foreach ($subgrupos as $subgrupo)
                                            <option value="{{ $subgrupo->id }}">{{ $subgrupo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_muestra_update">{{ __('Tipo de Muestra') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm est_muestra_update" id="est_muestra_update" name="est_muestra_update" onchange="obligado($(this))" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($muestras as $muestra)
                                            <option value="{{ $muestra->id }}">{{ $muestra->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_recipiente_update">{{ __('Recipiente') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm est_recipiente_update" id="est_recipiente_update" name="est_recipiente_update" onchange="opcional($(this))">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        @foreach ($recipientes as $recipiente)
                                            <option value="{{ $recipiente->id }}">{{ $recipiente->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_indicaciones_update">{{ __('Indicaciones') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm est_indicaciones_update" id="est_indicaciones_update" name="est_indicaciones_update" onchange="obligado($(this))">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        @foreach ($indicaciones as $indicacion)
                                            <option value="{{ $indicacion->id }}">{{ $indicacion->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_precio_update">{{ __('Precio') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-5">
                                    <input type="number" min="0" step="0.01" id="est_precio_update" name="est_precio_update" class="form-control form-control-sm est_precio_update" autocomplete="off" onkeyup="obligado($(this))" onchange="obligado($(this))" required>
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select custom-select-sm est_moneda_update" id="est_moneda_update" name="est_moneda_update" required>
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
                <button id="btnUpdateEstudio" class="btn btn-warning btnUpdateEstudio">Actualizar</button>
            </div>
        </div>
    </div>
</div>