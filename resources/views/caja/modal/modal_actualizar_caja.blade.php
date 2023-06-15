<div class="modal fade" id="modal_actualizar_caja" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_cajaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_cajaLabel"><strong>{{ __('Cerrar Caja') }}</strong></h1>
                <button type="button" id="btnCloseAddClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="caja_administrador">{{ __('Administrador') }}:</label>
                            <div class="col-md-8" style="display: inline-flex">
                                <input type="text" id="caja_administrador" name="caja_administrador" class="form-control form-control-sm caja_administrador" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                <input type="hidden" name="caja_id" id="caja_id" class="caja_id">
                                <div class="input-group-prepend" >
                                    <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px;"><i class="fas fa-user"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-sm-12">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="caja_fecha_apertura">{{ __('Fecha Apertura') }}:</label>
                            <div class="col-md-8" style="display: inline-flex">
                                <input type="datetime" id="caja_fecha_apertura" name="caja_fecha_apertura" class="form-control form-control-sm caja_fecha_apertura" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                <div class="input-group-prepend" >
                                    <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px;"><i class="fas fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table-descripcion tabla-facturas">
                            <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th width="150px">Tipo Pago</th>
                                    <th width="150px">Fecha</th>
                                    <th>Hora</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-right" style="background-color: #2AA6E5; color: white;">Total:</th>
                                    <th class="text-right caja_monto_cierre" style="background-color: #2AA6E5; color: white;"></th>
                                    <th style="background-color: #2AA6E5; color: white;">Bs</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-right" style="background-color: #2AA6E5; color: white;">Monto Apertura:</th>
                                    <th class="text-right caja_cambio" style="background-color: #2AA6E5; color: white;"></th>
                                    <th style="background-color: #2AA6E5; color: white;">Bs</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnActualizarCaja" class="btn btn-success btnActualizarCaja">Cerrar Caja</button>
            </div>
        </div>
    </div>
</div>
