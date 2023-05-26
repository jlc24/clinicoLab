<div class="modal fade" id="modal_resultados" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_resultadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_resultadosLabel"><strong>{{ __('Resultados') }}</strong></h1>
                <button type="button" id="btnCloseSaveResult" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 col-sm-12 " style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
                        <div class="row">
                            <div class="col-xl-7 col-sm-12" style="display: inline-flex;">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="res_cli_nombre">{{ __('Paciente') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <h1 class="col-form-label res_cli_nombre" id="res_cli_nombre"></h1>
                                    <input type="hidden" name="res_fac_id" id="res_fac_id" class="res_fac_id">
                                    <input type="hidden" name="res_rec_id" id="res_rec_id" class="res_rec_id">
                                    <input type="hidden" name="res_cli_id" id="res_cli_id" class="res_cli_id">
                                </div>
                            </div>
                            <div class="col-xl-5 col-sm-12" style="display: inline-flex">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="res_cli_recepcion">{{ __('Recepcion') }}:</label>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="col-form-label res_cli_recepcion" id="res_cli_recepcion"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-7 col-sm-12" style="display: inline-flex;">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="res_cli_genero">{{ __('Genero') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <h1 class="col-form-label res_cli_genero" id="res_cli_genero"></h1>
                                </div>
                            </div>
                            <div class="col-xl-5 col-sm-12" style="display: inline-flex">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="res_cli_edad">{{ __('Edad') }}:</label>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="col-form-label res_cli_edad" id="res_cli_edad"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 divReferencia" style="display: none;">
                                <div class="col-md-2">
                                    <label class="col-form-label" for="res_cli_referencias">{{ __('Referencias') }}: </label>
                                </div>
                                <div class="col-md-10">
                                    <h1 class="col-form-label res_cli_referencias" id="res_cli_referencias"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-sm-12 divObservacion" style="display: none;">
                                <div class="col-md-2">
                                    <label class="col-form-label" for="res_cli_observacion">{{ __('Observacion') }}: </label>
                                </div>
                                <div class="col-md-10">
                                    <h1 class="col-form-label res_cli_observacion" id="res_cli_observacion"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-7 col-sm-12" style="display: inline-flex;">
                                <div class="col-md-3">
                                    <label class="col-form-label" for="res_est_nombre">{{ __('Estudio') }}: </label>
                                </div>
                                <div class="col-md-9">
                                    <h1 class="col-form-label res_est_nombre" id="res_est_nombre"></h1>
                                    <input type="hidden" name="res_det_id" id="res_det_id" class="res_det_id">
                                </div>
                            </div>
                            <div class="col-xl-5 col-sm-12" style="display: inline-flex">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-3 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-form-label" for="fac_paciente_nombre">{{ __('Procedimiento') }}: </label>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-sm table-borderless tabla_procedimientos_resultado" id="tabla_procedimientos_resultado">
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row divComponentes" style="display: none">
                            <div class="col-md-12" >
                                <label class="col-form-label" for="fac_paciente_nombre">{{ __('Componentes') }}: </label>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-sm table-borderless tabla_componentes_resultado" id="tabla_componentes_resultado">
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-sm-12 divAspectos" style="display: none;">
                        <div class="row justify-content-center" >
                            <div class="col-xl-11 col-sm-11 text-center">
                                <label class="col-form-label nombre_comp_asp"></label>
                                <input type="hidden" name="res_dpc_id" id="res_dpc_id" class="res_dpc_id">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-sm-12 ">
                                <table class="table table-sm">
                                    <thead style="background-color: #BAECCA;">
                                        <th width="30px"></th>
                                        <th hidden>#</th>
                                        <th width="150px">{{ __('Aspecto') }}</th>
                                        <th width="100px">{{ __('Resultado') }}</th>
                                        <th class="text-center" width="100px">{{ __('Unidad') }}</th>
                                        <th class="text-center">{{ __('Parámetros') }}</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-xl-12 col-sm-12 table-responsive table-borderless mt-0 pt-0" style="height: 220px">
                                <table class="table table-sm table-hover tabla_aspectos_resultado" id="tabla_aspectos_resultado" >
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>