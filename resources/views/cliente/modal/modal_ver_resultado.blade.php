<div class="modal fade" id="modal_ver_resultado" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_resultadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_resultadoLabel"><strong>{{ __('Resultados del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseUpClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-borderless pb-0 mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50px">#</th>
                                    <th width="100px">{{ __('Codigo') }}</th>
                                    <th width="350px">{{ __('Estudio') }}</th>
                                    <th width="100px">{{ __('Precio') }}</th>
                                    <th width="120px" hidden>{{ __('Estado') }}</th>
                                    <th width="60px">{{ __('Estado') }}</th>
                                    <th width="50px">Op</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-xl-12 col-sm-12 table-responsive table-bordered" style="height: 300px;">
                        <table class="table table-sm table-hover tabla-resultados-cliente" id="tabla-resultados-cliente">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>