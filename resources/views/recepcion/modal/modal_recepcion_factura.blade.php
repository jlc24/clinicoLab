<div class="modal fade" id="modal_crear_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_facturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_facturaLabel"><strong>{{ __('Factura') }}</strong></h1>
                <button type="button" id="btnCloseUpFactura" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form method="POST" class="form-horizontal" id="form_crear_factura">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-7 col-sm-7" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #B8B4B2">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 mt-2">
                                    <label class="col-form-label">{{ __('DETALLE DE FACTURA') }}</label><hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-sm-3">
                                    <label class="col-form-label" for="fac_factura_id" >{{ __('Factura') }} Nº:</label>
                                </div>
                                <div class="col-xl-3 col-sm-3">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label fac_factura_id" for="fac_factura" id="fac_factura_id"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" >{{ __('Fecha') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="col-form-label" id="fac_fecha">{{ date('d/m/Y') }}</label>
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
                                        <div class="col-md-9" style="display: inline-flex">
                                            <input type="hidden" name="fac_paciente_id" id="fac_paciente_id">
                                            <label class="col-form-label" id="fac_paciente_nombre"></label>
                                        </div>
                                        <div class="col-md-3" style="display: inline-flex">
                                            <label class="col-form-label" id="fac_paciente_edad"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="block_empresa">
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" for="fac_empresa_nombre">{{ __('Empresa') }}:</label>
                                </div>
                                <div class="col-xl-10 col-sm-10">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="hidden" name="fac_empresa_id" id="fac_empresa_id">
                                            <label class="col-form-label" id="fac_empresa_nombre"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none" id="block_medico">
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" for="fac_medico_nombre">{{ __('Medico') }}:</label>
                                </div>
                                <div class="col-xl-10 col-sm-10">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="hidden" name="fac_medico_id" id="fac_medico_id">
                                            <label class="col-form-label" id="fac_medico_nombre"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                                    <th>{{ __('') }}</th>
                                                </thead>
                                                <tbody>
        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-5" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #B8B4B2;">
                            <div class="col-xl-12 col-sm-12 mt-2">
                                <label class="col-form-label" for="fac_factura" >{{ __('DETALLE DE PAGO') }}</label><hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-5 col-sm-5">
                                    <label class="col-form-label" for="fac_precio_total">{{ __('Total a pagar') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" id="fac_precio_total" name="fac_precio_total" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-3">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" value="Bs" id="fac_moneda_total" name="fac_moneda_total" class="form-control form-control-sm" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-5 col-sm-5">
                                    <label class="col-form-label" for="fac_tipo_pago">{{ __('Tipo de Pago') }}:</label>
                                </div>
                                <div class="col-xl-7 col-sm-7">
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
                            <div class="row">
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" for="fac_importe">{{ __('Importe') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" value="0.00" min="0" id="fac_importe" name="fac_importe" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" for="fac_cambio">{{ __('Cambio') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" value="0.00" id="fac_cambio" name="fac_cambio" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-xl-2 col-sm-2">
                                    <label class="col-form-label" for="fac_estado">{{ __('Estado') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" value="1" id="fac_estado" name="fac_estado" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" hidden>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_observacion">{{ __('Observacion') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" class="form-control form-control-sm" name="fac_observacion" id="fac_observacion">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_referencia">{{ __('Referencia') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" class="form-control form-control-sm" name="fac_referencia" id="fac_referencia">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success btn-facturar-recepcion">Registrar</button>
            </div>
        </div>
    </div>
</div>