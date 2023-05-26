<div class="modal fade" id="modal_ver_factura" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_facturaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_facturaLabel"><strong>{{ __('Facturas del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseUpClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" name="" id="" class="fac_cli_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-borderless pb-0 mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Fecha') }}</th>
                                    <th>{{ __('Hora') }}</th>
                                    <th>{{ __('Archivo') }}</th>
                                    <th>Op</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-xl-12 col-sm-12 table-responsive table-bordered" style="height: 300px;">
                        <table class="table table-sm table-hover tabla-facturas-cliente" id="tabla-facturas-cliente">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>