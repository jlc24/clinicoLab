<div class="modal fade" id="modal_agregar_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_agregar_materialLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #69A5FD; color: #fff">
                <h1 class="modal-title fs-5 modal_agregar_materialLabel" id="modal_agregar_materialLabel" ></h1>
                <button type="button" id="btnCloseAddMaterialEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-sm-12" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="search_material">{{ __('Material') }}: </label>
                            <div class="col-md-12">
                                <form id="form_search_material">
                                    <input type="text" id="search_material" name="search_material" class="form-control form-control-sm search_material" autocomplete="off" placeholder="Nombre Material" required>
                                </form>
                                <input type="hidden" name="detmat_ca_id" id="detmat_ca_id" class="detmat_ca_id">
                                <input type="hidden" name="est_detmat_ca_id" id="est_detmat_ca_id" class="est_detmat_ca_id">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-form-label" for="proc_nombre">{{ __('Lista de Materiales') }}: </label>
                            <div class="col-xl-12 col-sm-12">
                                <table class="table table-sm mb-0 pb-0">
                                    <thead class="text-center" style="background-color: #BBEAF2">
                                        <th hidden>#</th>
                                        <th width="100px">{{ __('Nombre') }}</th>
                                        <th class="text-center">{{ __('Medida') }}</th>
                                        <th width="50px">Op</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-xl-12 col-sm-12 table-responsive table-bordered" style="height: 300px;">
                                <table class="table table-sm table-hover tabla_lista_materiales" id="tabla_lista_materiales" >
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-sm-12" >
                        <div class="row justify-content-center" >
                            <div class="col-xl-11 col-sm-11 text-center">
                                <label class="col-form-label">{{ __('MATERIALES AGREGADOS') }}</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-sm-12 ">
                                <table class="table table-sm table-bordered mb-0 pb-0">
                                    <thead style="background-color: #BAECCA;">
                                        <th width="50px"></th>
                                        <th hidden>#</th>
                                        <th width="180px">Material</th>
                                        <th class="text-center" width="80px">Unidad</th>
                                        <th class="text-center" width="80px">Cantidad</th>
                                        <th class="text-center" width="100px">Precio(Bs)</th>
                                        <th class="text-center" width="40px">Op</th>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-xl-12 col-sm-12 table-responsive table-borderless" style="height: 320px">
                                <table class="table table-sm table-hover tabla_material_estudio" id="tabla_material_estudio" >
                                    
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div><hr>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-sm-12 ">
                                <table class="table table-sm table-borderless mb-0 pb-0">
                                    <tfoot >
                                        <tr>
                                            <td class="text-center" style="width: 30%">
                                                <button class="btn btn-sm btn-outline-info btnPruebaAnterior" title="Anterior" hidden><i class="fas fa-arrow-circle-left fa-2x"></i></button>
                                            </td>
                                            <td class="text-center" colspan="4">
                                                <button class="btn btn-sm btn-info btnPruebaActual" title="Actual"><i class="fas fa-bars fa-2x"></i></button>
                                            </td>
                                            <td class="text-center" style="width: 30%">
                                                <button class="btn btn-sm btn-outline-info btnPruebaSiguiente" title="Siguiente"><i class="fas fa-arrow-circle-right fa-2x"></i></button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>