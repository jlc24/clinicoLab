<div class="modal fade modal_cambiar_qr" id="modal_cambiar_qr" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_cambiar_qrLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_cambiar_qrLabel"><strong>{{ __('QR') }}</strong></h1>
                <button type="button" id="btnCloseShowQR" class="btn-close btnCloseShowQR" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="form-group row">
                        <div class="col-md-11" style="display: inline-flex;">
                            <input type="file" name="med_qr_update" id="med_qr_update" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file med_qr_update" onchange="VerImagen('med_qr_update', 'img_qr_update')">
                            <input type="hidden" name="med_id_qr" id="med_id_qr" class="med_id_qr">
                        </div>
                        <div class="col-xl-1 col-sm-1">
                            <button class="btn btn-sm btn-outline-info btnRefreshQR" title="Limpiar QR" disabled><i class="fas fa-refresh"></i></button>
                        </div>
                        <div class="col-md-12 text-center">
                            <small><span style="color: red;" id="error_med_nombre" class="error_med_nombre">(Tamaño máximo aprox. 2mb)</span></small>
                        </div>
                        <div class="col-md-12 text-center mt-2">
                            <img src="{{ asset('dist/img/default.png') }}" id="img_qr_update" class="img_qr_update" width="200px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateQR" class="btn btn-success btnUpdateQR" data-dismiss="modal" disabled>Actualizar QR</button>
            </div>
        </div>
    </div>
</div>