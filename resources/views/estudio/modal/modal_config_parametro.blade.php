<div class="modal fade" id="modal_config_parametro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_config_parametroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5 aspecto_nombre_parametro" id="modal_config_parametroLabel" >{{ __('Configurar Parámetros') }}</h1>
                <button type="button" id="btnCloseAddParametro" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="aspecto_id_parametro" id="aspecto_id_parametro" class="aspecto_id_parametro">
                <input type="hidden" name="est_ca_id" id="est_ca_id" class="est_ca_id">
                <input type="hidden" name="parametro_id" id="parametro_id" class="parametro_id">
                <input type="hidden" name="parametro_unidad" id="parametro_unidad" class="parametro_unidad">
                {{-- <div class="row ">
                    <button type="button" class="btn btn-sm btn-success btnAddValores" id="btnAddValores">Agregar mas valores <i class="fas fa-plus-circle fa-lg"></i></button>
                    <div class="col-xl-12 col-sm-12 mt-2">
                        <table class="table table-sm table-bordered table-responsive-lg table_parametro" id="table_parametro">
                            <thead class="text-center table-primary">
                                <th hidden>#</th>
                                <th width="100px">Genero</th>
                                <th colspan="2">Edad</th>
                                <th width="80px">Tiempo</th>
                                <th width="150px" colspan="2">Valores</th>
                                <th width="150px">Referencias</th>
                                <th width="50px">Op</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div> --}}
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-borderless">
                            <tbody>
                                <tr class="text-center">
                                    <th width="150px">GENERO</th>
                                    <th width="300px" colspan="2">EDAD</th>
                                    <th>TIEMPO</th>
                                    <th width="100px"></th>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="custom-select custom-select-sm parametro_genero" name="parametro_genero" id="parametro_genero" onchange="opcional($(this))">
                                            <option value="" selected>Elegir...</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                    </td>
                                    <td width="150px"><input type="number" min="0" step="1" placeholder="0" name="parametro_edad_inicial" id="parametro_edad_inicial" class="form-control form-control-sm parametro_edad_inicial" onkeyup="obligado($(this))"></td>
                                    <td width="150px"><input type="number" min="0" step="1" placeholder="0" name="parametro_edad_final" id="parametro_edad_final" class="form-control form-control-sm parametro_edad_final" onkeyup="obligado($(this))"></td>
                                    <td>
                                        <select class="custom-select custom-select-sm parametro_tiempo" name="parametro_tiempo" id="parametro_tiempo" onchange="obligado($(this))">
                                            <option value="" selected>Elegir...</option>
                                            <option value="AÑOS">AÑOS</option>
                                            <option value="MESES">MESES</option>
                                            <option value="DIAS">DIAS</option>
                                        </select>
                                    </td>
                                    <td rowspan="3" class="text-center" style="vertical-align: middle">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-success btn-save-parametro" title="Guardar Parametro" hidden><i class="fas fa-plus-circle fa-2x"></i></button>
                                            <button type="button" class="btn btn-sm btn-warning btn-edit-parametro-id" title="Modificar Parametro" hidden><i class="fas fa-edit fa-2x"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger btn-clear-parametro" title="Cancelar" hidden><i class="fas fa-close fa-2x"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th colspan="2">VALORES</th>
                                    <th>UNIDAD</th>
                                    <th>REFERENCIA</th>
                                </tr>
                                <tr>
                                    <td><input type="number" min="0" step="0.01" placeholder="0.00" name="parametro_valor_inicial" id="parametro_valor_inicial" class="form-control form-control-sm parametro_valor_inicial" onkeyup="opcional($(this))"></td>
                                    <td width="100px"><input type="number" min="0" step="0.01" placeholder="0.00" name="parametro_valor_final" id="parametro_valor_final" class="form-control form-control-sm parametro_valor_final" onkeyup="obligado($(this))"></td>
                                    <td width="100px">
                                        <select class="custom-select custom-select-sm parametro_unidad" name="parametro_unidad" id="parametro_unidad" onchange="opcional($(this))">
                                            <option value="">Seleccionar...</option>
                                            @foreach($unidades as $unidad)
                                                <option value="{{ $unidad->id }}">{{ $unidad->unidad }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" placeholder="Ej: 0.54-1.25 mmol/dl" name="parametro_referencia" id="parametro_referencia" class="form-control form-control-sm parametro_referencia" onkeyup="obligado($(this))"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-light table-sm mb-0 pb-0">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th hidden>#</th>
                                    <th width="100px">Genero</th>
                                    <th width="100px">Edad</th>
                                    <th width="80px">Tiempo</th>
                                    <th width="100px" >Valores</th>
                                    <th >Referencias</th>
                                    <th width="100px">Op</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-xl-12 col-sm-12 table-responsive table-bordered" style="height: 200px;">
                        <table class="table table-sm table-hover tabla_parametros" id="tabla_parametros">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-xl-4 col-sm-4 text-right">
                        <button class="btn btn-sm btn-outline-info btnAnteriorPrueba" title="Anterior"><i class="fas fa-arrow-alt-circle-left fa-2x"></i></button>
                    </div>
                    <div class="col-xl-4 col-sm-4 text-center">
                        <button class="btn btn-sm btn-info" title="Actual"><i class="fas fa-bars fa-2x"></i></button>
                    </div>
                    <div class="col-xl-4 col-sm-4 text-left">
                        <button class="btn btn-sm btn-outline-info btnSiguientePrueba" title="Siguiente"><i class="fas fa-arrow-alt-circle-right fa-2x"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>