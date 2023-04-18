<div class="modal fade" id="modal_crear_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_facturaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_facturaLabel"><strong>{{ __('Factura') }}</strong></h1>
                <button type="button" id="btnCloseUpFactura" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_crear_factura">
                    <div class="row">
                        <div class="col-xl-3 col-sm-3">
                            <label class="col-form-label" for="fac_factura" >{{ __('Factura') }} Nº:</label>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text"  id="fac_factura" name="fac_factura" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-form-label" >{{ __('Fecha') }}:</label>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="date" value="{{ date('Y-m-d') }}" placeholder="Fecha" id="rec_fecha" name="rec_fecha" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-form-label" for="fac_paciente_nombre">{{ __('Paciente') }}:</label>
                        </div>
                        <div class="col-xl-10 col-sm-10">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <input type="hidden" name="fac_paciente_id" id="fac_paciente_id">
                                    <input type="text" placeholder="Paciente" id="fac_paciente_nombre" name="fac_paciente_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <label class="col-form-label" for="tabla-factura">{{ __('Detalle') }}:</label>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <table class="table table-sm table-bordered table-responsive-lg" id="tabla-factura">
                                        <thead>
                                            <th>{{ __('Clave') }}</th>
                                            <th>{{ __('Estudio') }}</th>
                                            <th>{{ __('Precio') }}</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-sm-3">
                            <label class="col-form-label" for="fac_precio_total">{{ __('Total a pagar') }}:</label>
                        </div>
                        <div class="col-xl-5 col-sm-5">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <input type="text" id="fac_precio_total" name="fac_precio_total" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <input type="text" value="Bs" id="fac_moneda_total" name="fac_moneda_total" class="form-control form-control-sm" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-sm-3">
                            <label class="col-form-label" for="fac_tipo_pago">{{ __('Tipo de Pago') }}:</label>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <select class="custom-select custom-select-sm" id="fac_tipo_pago" name="fac_tipo_pago" required>
                                        <option value="EFECTIVO" selected>{{ __('EFECTIVO') }}</option>
                                        <option value="TARJETA CREDITO/DEBITO">{{ __('TARJETA CREDITO/DEBITO') }}</option>
                                        <option value="CHEQUE">{{ __('CHEQUE') }}</option>
                                        <option value="TRANSFERENCIA">{{ __('TRANSFERENCIA') }}</option>
                                        <option value="OTRO">{{ __('OTRO') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-form-label" for="fac_importe">{{ __('Importe') }}:</label>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <input type="number" value="0.00" min="0" id="fac_importe" name="fac_importe" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-sm-2">
                            <label class="col-form-label" for="fac_cambio">{{ __('Cambio') }}:</label>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group row">
                                <div class="col-md-12" style="display: inline-flex">
                                    <input type="number" value="0.00" id="fac_cambio" name="fac_cambio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <a href="javascript:void(0);"  id="btnRegisterFactura" class="btn btn-success">Registrar</a>
            </div>
        </div>
    </div>
</div>