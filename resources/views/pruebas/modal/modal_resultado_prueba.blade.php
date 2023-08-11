<div class="modal fade" id="modal_resultados_prueba" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_resultados_pruebaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_resultados_pruebaLabel">{{ __('Prueba') }}:<strong class="nombrePrueba"></strong></h1>
                <button type="button" id="btnCloseSaveResultPrueba" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-5 col-sm-12">
                        <h3>{{ __('Descripcion de Prueba') }}</h3>
                        <div class="col-xl-12 col-sm-12 " style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12" style="display: inline-flex;">
                                    <div class="col-md-2">
                                        <label class="col-form-label" for="res_estudio">{{ __('Estudio') }}: </label>
                                    </div>
                                    <div class="col-md-10">
                                        <h1 class="col-form-label res_estudio" id="res_estudio"></h1>
                                        <input type="hidden" name="res_fac_id" id="res_fac_id" class="res_fac_id">
                                        <input type="hidden" name="res_rec_id" id="res_rec_id" class="res_rec_id">
                                        <input type="hidden" name="res_ca_id" id="res_ca_id" class="res_ca_id">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12" style="display: inline-flex">
                                    <div class="col-md-2">
                                        <label class="col-form-label" for="res_grupo">{{ __('Grupo') }}:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <h1 class="col-form-label res_grupo" id="res_grupo"></h1>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="col-form-label" for="res_subgrupo" hidden>{{ __('Subgrupo') }}: </label>
                                    </div>
                                    <div class="col-md-4">
                                        <h1 class="col-form-label res_subgrupo" id="res_subgrupo"></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-sm-12">
                                    <label class="col-md-12 col-form-label" for="res_referencia">{{ __('Referencia') }}(s):</label>
                                </div>
                                <div class="col-xl-12 col-sm-12" >
                                    <div class="col-md-12">
                                        <table class="table table-sm table-bordered tabla_resultado_parametro">
                                            <thead>
                                                <th hidden>#</th>
                                                <th>{{ __('Referencia') }}</th>
                                                <th>{{ __('Genero') }}</th>
                                                <th colspan="2">{{ __('Edad') }}</th>
                                                <th>{{ __('Tiempo') }}</th>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-sm-12">
                        <h3>{{ __('Llenado de Resultados') }}</h3>
                        <div class="col-xl-12 col-sm-12 mt-3">
                            <table class="table table-sm mb-0 pt-0">
                                <thead style="background-color: #BAECCA;">
                                    <th width="5px"></th>
                                    <th width="100px">{{ __('Paciente') }}</th>
                                    <th width="100px">{{ __('Género') }}</th>
                                    <th width="100px">{{ __('Edad') }}</th>
                                    <th >{{ __('Tiempo') }}</th>
                                    <th hidden>Parametro</th>
                                    <th width="150px">{{ __('Resultado') }}</th>
                                    <th class="text-center" width="100px">{{ __('Unidad') }}</th>
                                    <th class="text-center" width="70px">Op</th>
                                </thead>
                            </table>
                        </div>
                        <div class="col-xl-12 col-sm-12 table-responsive table-borderless" style="height: 220px">
                            <table class="table table-sm table-hover tabla_pacientes_resultado" id="tabla_pacientes_resultado" >
                                <tbody>
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    
                </div>
            </div>
        </div>
    </div>
</div>