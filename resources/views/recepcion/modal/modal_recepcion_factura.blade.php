<div class="modal fade" id="modal_crear_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_facturaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                                            <table class="table-descripcion" id="tabla-factura">
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
                                                <option value="CREDITO/DEBITO">{{ __('TARJETA CREDITO/DEBITO') }}</option>
                                                <option value="CHEQUE">{{ __('CHEQUE') }}</option>
                                                <option value="TRANSFERENCIA">{{ __('TRANSFERENCIA') }}</option>
                                                <option value="OTRO">{{ __('OTRO') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row efectivo">
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
                            <div class="row tarjeta_credito_debito" hidden>
                                <div class="col-xl-4 col-sm-2">
                                    <label class="col-form-label" for="fac_num_tarjeta">{{ __('Nº Tarjeta') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" maxlength="16" placeholder="**** **** **** ****" id="fac_num_tarjeta" name="fac_num_tarjeta" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-2">
                                    <label class="col-form-label" for="fac_fecha_exp">{{ __('Fecha de Exp.') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select id="fac_fecha_exp_mes" class="custom-select custom-select-sm" name="fac_fecha_exp_mes">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select id="fac_fecha_exp_anio" class="custom-select custom-select-sm" name="fac_fecha_exp_anio">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-2">
                                    <label class="col-form-label" for="fac_num_tarjeta">{{ __('Titular') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" id="fac_num_tarjeta" name="fac_num_tarjeta" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-2">
                                    <label class="col-form-label" for="fac_num_tarjeta">{{ __('CVV/CVC') }}:</label>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" maxlength="3" max="999" min="000" id="fac_num_tarjeta" name="fac_num_tarjeta" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row cheque" hidden>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_num_cheque">{{ __('Nº Cheque') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" class="form-control form-control-sm" name="fac_num_cheque" id="fac_num_cheque">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_cheque_banco">{{ __('Banco') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select id="fac_cheque_banco" class="custom-select custom-select-sm fac_cheque_banco" name="fac_cheque_banco">
                                                <option value="" selected disabled>Seleccionar...</option>
                                                <option value="BANCO DE CREDITO (BCP)">BANCO DE CREDITO (BCP)</option>
                                                <option value="BANCO BISA">BANCO BISA</option>
                                                <option value="BANCO DE LA NACION ARGENTINA">BANCO DE LA NACION ARGENTINA</option>
                                                <option value="BANCO FORTALEZA">BANCO FORTALEZA</option>
                                                <option value="BANCO GANADERO">BANCO GANADERO</option>
                                                <option value="BANCO SOLIDARIO">BANCO SOLIDARIO</option>
                                                <option value="BANCO FIE">BANCO FIE</option>
                                                <option value="BANCO MERCANTIL SANTA CRUZ">BANCO MERCANTIL SANTA CRUZ</option>
                                                <option value="BANCO NACIONAL DE BOLIVIA">BANCO NACIONAL DE BOLIVIA</option>
                                                <option value="BANCO ECONOMICO">BANCO ECONOMICO</option>
                                                <option value="BANCO UNION">BANCO UNION</option>
                                                <option value="BANCO CENTRAL DE BOLIVIA">BANCO CENTRAL DE BOLIVIA</option>
                                                <option value="BANCO DE DESARROLLO PRODUCTIVO">BANCO DE DESARROLLO PRODUCTIVO</option>
                                                <option value="BANCO PYME DE LA COMUNIDAD">BANCO PYME DE LA COMUNIDAD</option>
                                                <option value="BANCO PYME ECOFUTURO">BANCO PYME ECOFUTURO</option>
                                                <option value="LA PRIMERA - EFV">LA PRIMERA - EFV</option>
                                                <option value="LA PROMOTORA - EFV">LA PROMOTORA - EFV</option>
                                                <option value="EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA">EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA</option>
                                                <option value="EL PROGRESO - EFV">EL PROGRESO - EFV</option>
                                                <option value="PRO MUJER IFD">PRO MUJER IFD</option>
                                                <option value="FONDECO IFD">FONDECO IFD</option>
                                                <option value="SEMBRAR SARTAWI - IFD">SEMBRAR SARTAWI - IFD</option>
                                                <option value="IMPRO IFD">IMPRO IFD</option>
                                                <option value="CRECER IFD">CRECER IFD</option>
                                                <option value="CIDRE IFD">CIDRE IFD</option>
                                                <option value="IDEPRO IFD">IDEPRO IFD</option>
                                                <option value="FUNDACION PRO MUJER IFD">FUNDACION PRO MUJER IFD</option>
                                                <option value="DIACONIA IFD">DIACONIA IFD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_cheque_fecha">{{ __('Fecha') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="date" class="form-control form-control-sm" name="fac_cheque_fecha" id="fac_cheque_fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_cheque_destino">{{ __('Destinatario') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" class="form-control form-control-sm" name="fac_cheque_destino" id="fac_cheque_destino">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row transferencia" hidden>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_banco">{{ __('Banco') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select id="fac_trans_banco" class="custom-select custom-select-sm fac_trans_banco" name="fac_trans_banco">
                                                <option value="" selected disabled>Seleccionar...</option>
                                                <option value="BANCO DE CREDITO (BCP)">BANCO DE CREDITO (BCP)</option>
                                                <option value="BANCO BISA">BANCO BISA</option>
                                                <option value="BANCO DE LA NACION ARGENTINA">BANCO DE LA NACION ARGENTINA</option>
                                                <option value="BANCO FORTALEZA">BANCO FORTALEZA</option>
                                                <option value="BANCO GANADERO">BANCO GANADERO</option>
                                                <option value="BANCO SOLIDARIO">BANCO SOLIDARIO</option>
                                                <option value="BANCO FIE">BANCO FIE</option>
                                                <option value="BANCO MERCANTIL SANTA CRUZ">BANCO MERCANTIL SANTA CRUZ</option>
                                                <option value="BANCO NACIONAL DE BOLIVIA">BANCO NACIONAL DE BOLIVIA</option>
                                                <option value="BANCO ECONOMICO">BANCO ECONOMICO</option>
                                                <option value="BANCO UNION">BANCO UNION</option>
                                                <option value="BANCO CENTRAL DE BOLIVIA">BANCO CENTRAL DE BOLIVIA</option>
                                                <option value="BANCO DE DESARROLLO PRODUCTIVO">BANCO DE DESARROLLO PRODUCTIVO</option>
                                                <option value="BANCO PYME DE LA COMUNIDAD">BANCO PYME DE LA COMUNIDAD</option>
                                                <option value="BANCO PYME ECOFUTURO">BANCO PYME ECOFUTURO</option>
                                                <option value="LA PRIMERA - EFV">LA PRIMERA - EFV</option>
                                                <option value="LA PROMOTORA - EFV">LA PROMOTORA - EFV</option>
                                                <option value="EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA">EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA</option>
                                                <option value="EL PROGRESO - EFV">EL PROGRESO - EFV</option>
                                                <option value="PRO MUJER IFD">PRO MUJER IFD</option>
                                                <option value="FONDECO IFD">FONDECO IFD</option>
                                                <option value="SEMBRAR SARTAWI - IFD">SEMBRAR SARTAWI - IFD</option>
                                                <option value="IMPRO IFD">IMPRO IFD</option>
                                                <option value="CRECER IFD">CRECER IFD</option>
                                                <option value="CIDRE IFD">CIDRE IFD</option>
                                                <option value="IDEPRO IFD">IDEPRO IFD</option>
                                                <option value="FUNDACION PRO MUJER IFD">FUNDACION PRO MUJER IFD</option>
                                                <option value="DIACONIA IFD">DIACONIA IFD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_comprobante">{{ __('Nº Comprobante') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" class="form-control form-control-sm" name="fac_trans_comprobante" id="fac_trans_comprobante">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_fecha">{{ __('Fecha') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="datetime-local" class="form-control form-control-sm" name="fac_trans_fecha" id="fac_trans_fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_cta_remit">{{ __('Cta. Remitente') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" class="form-control form-control-sm" name="fac_trans_cta_remit" id="fac_trans_cta_remit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_nombre_remit">{{ __('Nombre Remitente') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" class="form-control form-control-sm" name="fac_trans_nombre_remit" id="fac_trans_nombre_remit">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_banco_destino">{{ __('Banco Destinatario') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <select id="fac_trans_banco_destino" class="custom-select custom-select-sm fac_trans_banco_destino" name="fac_trans_banco_destino">
                                                <option value="" selected disabled>Seleccionar...</option>
                                                <option value="BANCO DE CREDITO (BCP)">BANCO DE CREDITO (BCP)</option>
                                                <option value="BANCO BISA">BANCO BISA</option>
                                                <option value="BANCO DE LA NACION ARGENTINA">BANCO DE LA NACION ARGENTINA</option>
                                                <option value="BANCO FORTALEZA">BANCO FORTALEZA</option>
                                                <option value="BANCO GANADERO">BANCO GANADERO</option>
                                                <option value="BANCO SOLIDARIO">BANCO SOLIDARIO</option>
                                                <option value="BANCO FIE">BANCO FIE</option>
                                                <option value="BANCO MERCANTIL SANTA CRUZ">BANCO MERCANTIL SANTA CRUZ</option>
                                                <option value="BANCO NACIONAL DE BOLIVIA">BANCO NACIONAL DE BOLIVIA</option>
                                                <option value="BANCO ECONOMICO">BANCO ECONOMICO</option>
                                                <option value="BANCO UNION">BANCO UNION</option>
                                                <option value="BANCO CENTRAL DE BOLIVIA">BANCO CENTRAL DE BOLIVIA</option>
                                                <option value="BANCO DE DESARROLLO PRODUCTIVO">BANCO DE DESARROLLO PRODUCTIVO</option>
                                                <option value="BANCO PYME DE LA COMUNIDAD">BANCO PYME DE LA COMUNIDAD</option>
                                                <option value="BANCO PYME ECOFUTURO">BANCO PYME ECOFUTURO</option>
                                                <option value="LA PRIMERA - EFV">LA PRIMERA - EFV</option>
                                                <option value="LA PROMOTORA - EFV">LA PROMOTORA - EFV</option>
                                                <option value="EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA">EL PROGRESO ENTIDAD FINANCIERA DE VIVIENDA</option>
                                                <option value="EL PROGRESO - EFV">EL PROGRESO - EFV</option>
                                                <option value="PRO MUJER IFD">PRO MUJER IFD</option>
                                                <option value="FONDECO IFD">FONDECO IFD</option>
                                                <option value="SEMBRAR SARTAWI - IFD">SEMBRAR SARTAWI - IFD</option>
                                                <option value="IMPRO IFD">IMPRO IFD</option>
                                                <option value="CRECER IFD">CRECER IFD</option>
                                                <option value="CIDRE IFD">CIDRE IFD</option>
                                                <option value="IDEPRO IFD">IDEPRO IFD</option>
                                                <option value="FUNDACION PRO MUJER IFD">FUNDACION PRO MUJER IFD</option>
                                                <option value="DIACONIA IFD">DIACONIA IFD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_cta_destino">{{ __('Cta. Destinatario') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="number" class="form-control form-control-sm" name="fac_trans_cta_destino" id="fac_trans_cta_destino">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <label class="col-form-label" for="fac_trans_nombre_destino">{{ __('Nombre Destinatario') }}:</label>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div class="form-group row">
                                        <div class="col-md-12" style="display: inline-flex">
                                            <input type="text" class="form-control form-control-sm" name="fac_trans_nombre_destino" id="fac_trans_nombre_destino">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row otro" hidden>
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