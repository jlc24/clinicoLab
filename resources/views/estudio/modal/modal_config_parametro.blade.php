<div class="modal fade" id="modal_config_parametro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_config_parametroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_config_parametroLabel">{{ __('Configurar Parámetros') }}</h1>
                <button type="button" id="btnCloseAddEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-sm-10">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="">{{ __('Selecciones parámetros') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select custom-select-sm parametro_proc_est" name="parametro_proc_est" id="parametro_proc_est">
                                    <option value="" selected >Seleccionar...</option>
                                    <option value="tablas">Tabla</option>
                                    <option value="sexoedades">Sexo y Edad</option>
                                    <option value="rangos">Rango</option>
                                    <option value="cualitativos">Cualitativo</option>
                                    <option value="textos">Texto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row parametro_tabla" style="display: none;">
                    <label class="col-md-4 col-form-label" for="">{{ __('Tabla') }}</label>
                </div>
                <div class="row parametro_sexoedad" style="display: none;">
                    <div class="row">
                        <label class="col-md-4 col-form-label" for="">{{ __('Sexo y Edad') }}</label>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-sm btn-success btnAddValoresSexo" id="btnAddValoresSexo">Valores por Sexo y Edad <i class="fas fa-plus-circle fa-lg"></i></button>
                        <div class="col-xl-12 col-sm-12">
                            <table class="table table-sm table-responsive-lg table_parametro_sexoedad" id="table_parametro_sexoedad">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row parametro_rango" style="display: none;">
                    <div class="row">
                        <label class="col-md-4 col-form-label" for="">{{ __('Rango') }}</label>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-sm btn-success btnAddValoresRango" id="btnAddValoresRango">Valores por Rango <i class="fas fa-plus-circle fa-lg"></i></button>
                        <div class="col-xl-12 col-sm-12">
                            <table class="table table-sm table-responsive-lg table_parametro_rango" id="table_parametro_rango">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row parametro_cualitativo" style="display: none;">
                    <label class="col-md-4 col-form-label" for="">{{ __('Cualitativo') }}</label>
                </div>
                <div class="row parametro_texto" style="display: none;">
                    <label class="col-md-4 col-form-label" for="">{{ __('Texto') }}</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnRegisterEst" class="btn btn-success">Registrar</button>
            </div>
        </div>
    </div>
</div>