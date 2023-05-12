<div class="modal fade" id="modal_cambio_moneda" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_cambio_monedaLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_cambio_monedaLabel"><strong>{{ __('Convertir USD/BOB') }}</strong></h1>
                <button type="button" id="btnCloseCambio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">
                <form action="">
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label" for="simpleinput"><i class="flag-icon flag-icon-us"></i> USD - Dólar Americano</label>
                        <div class="col-md-12">
                            <input type="number" min="0" id="usd" name="usd" class="form-control form-control-sm" value="1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-12 col-form-label" for="simpleinput"><i class="flag-icon flag-icon-bo"></i> BOB - Boliviano de Bolivia</label>
                        <div class="col-md-12">
                            <input type="number" id="bob" name="bob" class="form-control form-control-sm" value="6.91">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="create_importe" class="btn btn-warning" data-dismiss="modal">Registrar Importe</button>
            </div>
        </div>
    </div>
</div>