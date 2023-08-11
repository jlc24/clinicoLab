<div class="modal fade" id="modal_abastecer_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_abastecer_materialLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5 modal_abastecer_materialLabel" id="modal_abastecer_materialLabel"></h1>
                <button type="button" id="btnCloseAddCompra" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center" hidden>
                    <div class="col-xl-3 col-sm-3">
                        <img src="" id="show_img_material_abastecer" class="show_img_material_abastecer" width="180px"  style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="mat_cod_abastecer">{{ __('Cod.') }}:</label>
                            <div class="col-md-8">
                                <input type="text" id="mat_cod_abastecer" name="mat_cod_abastecer" class="form-control form-control-sm mat_cod_abastecer" autocomplete="off" style="font-weight: 500; background-color:#FACE80;" readonly>
                                <input type="hidden" name="mat_id_abastecer" id="mat_id_abastecer" class="mat_id_abastecer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="mat_nombre_abastecer">{{ __('Nombre') }}:</label>
                            <div class="col-md-8">
                                <input type="text" id="mat_nombre_abastecer" name="mat_nombre_abastecer" class="form-control form-control-sm mat_nombre_abastecer" autocomplete="off" style="font-weight: 500; background-color:#FACE80;" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="equipo" hidden>
                    <form id="formulario_comprar_material" class="formulario_comprar_material">
                    <div class="row justify-content-center">
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-md-12 col-form-label" for="mat_cod_compra_abastecer_equipo">{{ __('Codigo') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <input type="text" placeholder="ej: 7001105-STAT-FAX-4700" id="mat_cod_compra_abastecer_equipo" name="mat_cod_compra_abastecer_equipo" class="form-control form-control-sm mat_cod_compra_abastecer_equipo" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-md-12 col-form-label" for="mat_precio_compra_abastecer_equipo">{{ __('P. Compra') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <input type="number" min="0" step="0.01" value="0.00" id="mat_precio_compra_abastecer_equipo" name="mat_precio_compra_abastecer_equipo" class="form-control form-control-sm mat_precio_compra_abastecer_equipo" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer_equipo', '#mat_precio_compra_abastecer_equipo', '#mat_precio_unitario_abastecer_equipo')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer_equipo', '#mat_precio_compra_abastecer_equipo', '#mat_precio_unitario_abastecer_equipo')" required>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2" hidden>
                            <label class="col-md-12 col-form-label" for="mat_cantidad_abastecer_equipo">{{ __('Cantidad') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <input type="number" value="100" id="mat_cantidad_abastecer_equipo" name="mat_cantidad_abastecer_equipo" class="form-control form-control-sm mat_cantidad_abastecer_equipo" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer_equipo', '#mat_precio_compra_abastecer_equipo', '#mat_precio_unitario_abastecer_equipo')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer_equipo', '#mat_precio_compra_abastecer_equipo', '#mat_precio_unitario_abastecer_equipo')" required>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <label class="col-md-12 col-form-label" for="mat_vida_util_abastecer_equipo">{{ __('Tiempo de Vida Util') }}:<span class="dato_requerido">*</span></label>
                            <div style="display: inline-flex">
                                <div class="col-md-6">
                                    <input type="number" min="0" step="1" id="mat_vida_util_abastecer_equipo" name="mat_vida_util_abastecer_equipo" class="form-control form-control-sm mat_vida_util_abastecer_equipo" readonly>
                                </div>
                                <div class="col-md-6">
                                    <select id="mat_tipo_fecha_abastecer_equipo" name="mat_tipo_fecha_abastecer_equipo" class="custom-select custom-select-sm mat_tipo_fecha_abastecer_equipo" disabled>
                                        <option value="" >Seleccionar...</option>
                                        <option value="anios" selected>AÑOS</option>
                                        <option value="mes">MESES</option>
                                        <option value="dia">DIAS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <label class="col-md-12 col-form-label" for="mat_depreciacion_abastecer_equipo">{{ __('Depreciacion anual') }}:<span class="dato_requerido">*</span></label>
                            <div style="display: inline-flex">
                                <div class="col-md-6">
                                    <input type="number"  id="mat_depreciacion_abastecer_equipo" name="mat_depreciacion_abastecer_equipo" class="form-control form-control-sm mat_depreciacion_abastecer_equipo" readonly>
                                </div>
                                <div class="col-md-6">
                                    <select id="mat_unidad_abastecer_equipo" name="mat_unidad_abastecer_equipo" class="custom-select custom-select-sm mat_unidad_abastecer_equipo" disabled>
                                        <option value="" selected>Seleccionar...</option>
                                        @foreach ($medidas as $medida)
                                            <option value="{{ $medida->id }}">{{ $medida->unidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2" hidden>
                            <label class="col-md-12 col-form-label" for="mat_precio_unitario_abastecer_equipo">{{ __('P. Unitario') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <input type="number" value="0.00" id="mat_precio_unitario_abastecer_equipo" name="mat_precio_unitario_abastecer_equipo" class="form-control form-control-sm mat_precio_unitario_abastecer_equipo" readonly>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4" hidden>
                            <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                                <label class="col-md-5 col-form-label" for="mat_fecha_elab_abastecer_equipo">{{ __('Fecha Elab.') }}:</label>
                                <div class="col-md-7">
                                    <input type="date" id="mat_fecha_elab_abastecer_equipo" name="mat_fecha_elab_abastecer_equipo" class="form-control form-control-sm mat_fecha_elab_abastecer_equipo">
                                </div>
                            </div>
                            <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                                <label class="col-md-5 col-form-label" for="mat_fecha_venc_abastecer_equipo">{{ __('Fecha Ven.') }}:</label>
                                <div class="col-md-7">
                                    <input type="date" id="mat_fecha_venc_abastecer_equipo" name="mat_fecha_venc_abastecer_equipo" class="form-control form-control-sm mat_fecha_venc_abastecer_equipo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="otros" hidden>
                        <div class="row justify-content-center">
                            <div class="col-xl-2 col-sm-2">
                                <label class="col-md-12 col-form-label" for="mat_cod_compra_abastecer">{{ __('Codigo') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="ej: 7001105-STAT-FAX-4700" id="mat_cod_compra_abastecer" name="mat_cod_compra_abastecer" class="form-control form-control-sm mat_precio_compra_abastecer" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-2">
                                <label class="col-md-12 col-form-label" for="mat_unidad_abastecer">{{ __('Unidad') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-12">
                                    <select id="mat_unidad_abastecer" name="mat_unidad_abastecer" class="custom-select custom-select-sm mat_unidad_abastecer" >
                                        <option value="" selected>Seleccionar...</option>
                                        @foreach ($medidas as $medida)
                                            <option value="{{ $medida->id }}">{{ $medida->unidad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-2">
                                <label class="col-md-12 col-form-label" for="mat_cantidad_abastecer">{{ __('Cantidad') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" min="0" placeholder="0" id="mat_cantidad_abastecer" name="mat_cantidad_abastecer" class="form-control form-control-sm mat_cantidad_abastecer" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer', '#mat_precio_compra_abastecer', '#mat_precio_unitario_abastecer')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer', '#mat_precio_compra_abastecer', '#mat_precio_unitario_abastecer')" required>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-2">
                                <label class="col-md-12 col-form-label" for="mat_precio_compra_abastecer">{{ __('P. Compra') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" min="0" placeholder="0,00" id="mat_precio_compra_abastecer" name="mat_precio_compra_abastecer" class="form-control form-control-sm mat_precio_compra_abastecer" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer', '#mat_precio_compra_abastecer', '#mat_precio_unitario_abastecer')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer', '#mat_precio_compra_abastecer', '#mat_precio_unitario_abastecer')" required>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-2" hidden>
                                <label class="col-md-12 col-form-label" for="mat_precio_unitario_abastecer">{{ __('P. Unitario') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" value="0.00" id="mat_precio_unitario_abastecer" name="mat_precio_unitario_abastecer" class="form-control form-control-sm mat_precio_unitario_abastecer" readonly>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4">
                                <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                                    <label class="col-md-5 col-form-label" for="mat_fecha_elab_abastecer">{{ __('Fecha Elab.') }}:</label>
                                    <div class="col-md-7">
                                        <input type="date" id="mat_fecha_elab_abastecer" name="mat_fecha_elab_abastecer" class="form-control form-control-sm mat_fecha_elab_abastecer">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                                    <label class="col-md-5 col-form-label" for="mat_fecha_venc_abastecer">{{ __('Fecha Ven.') }}:</label>
                                    <div class="col-md-7">
                                        <input type="date" id="mat_fecha_venc_abastecer" name="mat_fecha_venc_abastecer" class="form-control form-control-sm mat_fecha_venc_abastecer">
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-sm-3">
                            <label class="col-md-12 col-form-label" for="mat_tipo_pago_abastecer">{{ __('Tipo Compra') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <select id="mat_tipo_pago_abastecer" name="mat_tipo_pago_abastecer" class="custom-select custom-select-sm mat_tipo_pago_abastecer" style="border-radius: 5px 0px 0px 5px;" >
                                    <option value="" selected>Seleccionar...</option>
                                    <option value="EFECTIVO" >EFECTIVO</option>
                                    <option value="CHEQUE" >CHEQUE</option>
                                    <option value="OTRO" >OTRO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <label class="col-md-12 col-form-label" for="mat_proveedor_abastecer">{{ __('Proveedor') }}:</label>
                            <div class="col-md-12">
                                <select id="mat_proveedor_abastecer" name="mat_proveedor_abastecer" class="custom-select custom-select-sm mat_proveedor_abastecer" style="border-radius: 5px 0px 0px 5px;" >
                                    <option value="" selected>Seleccionar...</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->empresa->emp_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <label class="col-md-12 col-form-label" for="mat_observacion_abastecer">{{ __('Observacion') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-12">
                                <textarea name="mat_observacion_abastecer" id="mat_observacion_abastecer" rows="3" class="form-control form-control-sm mat_observacion_abastecer" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-2">
                    <div class="col-xl-12 col-sm-12 text-right">
                        <button id="btnRegistrarCompra" class="btn btn-success btnRegistrarCompra" >Abastecer material</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-12 table-bordered table-responsive col-sm-12" style="height: 200px;">
                        <table class="table table-sm table-hover table-light tabla_compra_material" id="tabla_compra_material">
                            <thead class="thead-light">
                                <tr>
                                    <th >#</th>
                                    <th>{{ __('Cantidad') }}</th>
                                    <th>{{ __('Unidad') }}</th>
                                    <th>{{ __('Precio Compra(Bs)') }}</th>
                                    <th>{{ __('Precio Unitario(Bs)') }}</th>
                                    <th>{{ __('Fecha Vencimiento') }}</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Op</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>