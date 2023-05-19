<div class="modal fade" id="modal_config_parametro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_config_parametroLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5 aspecto_nombre_parametro" id="modal_config_parametroLabel" >{{ __('Configurar Parámetros') }}</h1>
                <button type="button" id="btnCloseAddParametro" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="aspecto_id_parametro" id="aspecto_id_parametro" class="aspecto_id_parametro">
                <div class="row ">
                    <button type="button" class="btn btn-sm btn-success btnAddValores" id="btnAddValores">Agregar mas valores <i class="fas fa-plus-circle fa-lg"></i></button>
                    <div class="col-xl-12 col-sm-12 mt-2">
                        <table class="table table-sm table-bordered table-responsive-lg table_parametro" id="table_parametro">
                            <thead class="text-center table-primary">
                                <th hidden>#</th>
                                <th width="100px">Genero</th>
                                <th colspan="2">Edad</th>
                                <th width="80px">Tiempo</th>
                                <th width="150px" colspan="2">Valores</th>
                                <th width="150px">Referencias</th>
                                <th width="50px">Op</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>