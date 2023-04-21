<div class="modal fade" id="modal_enviar_cotizacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_enviar_cotizacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_enviar_cotizacionLabel"><strong>{{ __('Enviar Cotizacion de estudios') }}</strong></h1>
                <button type="button" id="btnCloseSendCot" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-2 col-sm-2 text-right">
                        <label class="col-form-label" for="enviar_numero" ><i class="fas fa-phone-alt fa-2x text-success"></i></label>
                    </div>
                    <div class="col-xl-2 col-sm-2">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" value="591" id="enviar_numero_codigo" name="enviar_numero_codigo" class="form-control form-control-sm" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-sm-5">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="number" id="enviar_numero" name="enviar_numero" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-sm-12">
                        <label class="col-form-label" for="enviar_texto" >{{ __('Contenido del texto') }}:</label>
                    </div>
                    <div class="col-xl-10 col-sm-10">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea class="form-control" name="enviar_texto" id="enviar_texto" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" id="btnEnviarMensaje" target="_blank" rel="noreferrer">Enviar</a>
            </div>
        </div>
    </div>
</div>