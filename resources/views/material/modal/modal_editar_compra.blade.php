<div class="modal fade" id="modal_editar_compra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_editar_compraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5 modal_editar_compraLabel" id="modal_editar_compraLabel">Editar Compra</h1>
                <button type="button" id="btnCloseUpCompra" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center" hidden>
                    <div class="col-xl-3 col-sm-3">
                        <img src="" id="show_img_material_abastecer" class="show_img_material_abastecer" width="180px"  style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="mat_cod_abastecer_update">{{ __('Cod.') }}:</label>
                            <div class="col-md-8">
                                <input type="text" id="mat_cod_abastecer_update" name="mat_cod_abastecer_update" class="form-control form-control-sm mat_cod_abastecer_update" autocomplete="off" style="font-weight: 500; background-color:#FACE80;" readonly>
                                <input type="hidden" name="mat_id_abastecer_update" id="mat_id_abastecer_update" class="mat_id_abastecer_update">
                                <input type="hidden" name="comp_id_update" id="comp_id_update" class="comp_id_update">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-sm-3">
                        <label class="col-md-12 col-form-label" for="mat_unidad_abastecer_update">{{ __('Unidad') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <select id="mat_unidad_abastecer_update" name="mat_unidad_abastecer_update" class="custom-select custom-select-sm mat_unidad_abastecer_update" >
                                <option value="" selected>Seleccionar...</option>
                                @foreach ($medidas as $medida)
                                    <option value="{{ $medida->id }}">{{ $medida->unidad }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <label class="col-md-12 col-form-label" for="mat_cantidad_abastecer_update">{{ __('Cantidad') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <input type="number" value="0" id="mat_cantidad_abastecer_update" name="mat_cantidad_abastecer_update" class="form-control form-control-sm mat_cantidad_abastecer_update" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer_update', '#mat_precio_compra_abastecer_update', '#mat_precio_unitario_abastecer_update')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer_update', '#mat_precio_compra_abastecer_update', '#mat_precio_unitario_abastecer_update')" required>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-3">
                        <label class="col-md-12 col-form-label" for="mat_precio_compra_abastecer_update">{{ __('P. Compra') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <input type="number" value="0.00" id="mat_precio_compra_abastecer_update" name="mat_precio_compra_abastecer_update" class="form-control form-control-sm mat_precio_compra_abastecer_update" onkeyup="calcularPrecioCantidad('#mat_cantidad_abastecer_update', '#mat_precio_compra_abastecer_update', '#mat_precio_unitario_abastecer_update')" onchange="calcularPrecioCantidad('#mat_cantidad_abastecer_update', '#mat_precio_compra_abastecer_update', '#mat_precio_unitario_abastecer_update')" required>
                        </div>
                    </div>
                    <div class="col-xl3 col-sm-3">
                        <label class="col-md-12 col-form-label" for="mat_precio_unitario_abastecer_update">{{ __('P. Unitario') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <input type="number" value="0.00" id="mat_precio_unitario_abastecer_update" name="mat_precio_unitario_abastecer_update" class="form-control form-control-sm mat_precio_unitario_abastecer_update" readonly>
                        </div>
                    </div>
                </div><br>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-sm-12">
                        <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                            <label class="col-md-5 col-form-label" for="mat_fecha_elab_abastecer_update">{{ __('Fecha Elab.') }}:</label>
                            <div class="col-md-7">
                                <input type="date" id="mat_fecha_elab_abastecer_update" name="mat_fecha_elab_abastecer_update" class="form-control form-control-sm mat_fecha_elab_abastecer_update">
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                            <label class="col-md-5 col-form-label" for="mat_fecha_venc_abastecer_update">{{ __('Fecha Ven.') }}:</label>
                            <div class="col-md-7">
                                <input type="date" id="mat_fecha_venc_abastecer_update" name="mat_fecha_venc_abastecer_update" class="form-control form-control-sm mat_fecha_venc_abastecer_update">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-4">
                        <label class="col-md-12 col-form-label" for="mat_tipo_pago_abastecer_update">{{ __('Tipo Compra') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <select id="mat_tipo_pago_abastecer_update" name="mat_tipo_pago_abastecer_update" class="custom-select custom-select-sm mat_tipo_pago_abastecer_update" style="border-radius: 5px 0px 0px 5px;" >
                                <option value="" selected>Seleccionar...</option>
                                <option value="EFECTIVO" >EFECTIVO</option>
                                <option value="CHEQUE" >CHEQUE</option>
                                <option value="OTRO" >OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-5 col-sm-4">
                        <label class="col-md-12 col-form-label" for="mat_proveedor_abastecer_update">{{ __('Proveedor') }}:</label>
                        <div class="col-md-12">
                            <select id="mat_proveedor_abastecer_update" name="mat_proveedor_abastecer_update" class="custom-select custom-select-sm mat_proveedor_abastecer_update" style="border-radius: 5px 0px 0px 5px;" >
                                <option value="" selected>Seleccionar...</option>
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->empresa->emp_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-12 col-sm-12">
                        <label class="col-md-12 col-form-label" for="mat_observacion_abastecer_update">{{ __('Observacion') }}:<span class="dato_requerido">*</span></label>
                        <div class="col-md-12">
                            <textarea name="mat_observacion_abastecer_update" id="mat_observacion_abastecer_update" rows="2" class="form-control form-control-sm mat_observacion_abastecer_update"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-12 col-sm-12 text-right">
                        <button id="btnUpdateCompra" class="btn btn-success btnUpdateCompra" data-dismiss="modal">Actualizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>