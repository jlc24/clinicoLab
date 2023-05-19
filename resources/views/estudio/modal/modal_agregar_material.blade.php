<div class="modal fade" id="modal_agregar_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_agregar_materialLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #69A5FD; color: #fff">
                <h1 class="modal-title fs-5 modal_agregar_materialLabel" id="modal_agregar_materialLabel" ></h1>
                <button type="button" id="btnCloseAddMaterialEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-4 col-sm-4" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label" for="search_material">{{ __('Material') }}: </label>
                            <div class="col-md-12">
                                <form id="form_search_material">
                                    <input type="text" id="search_material" name="search_material" class="form-control form-control-sm search_material" autocomplete="off" placeholder="Nombre Material" required>
                                </form>
                                <input type="hidden" name="detmat_det_id" id="detmat_det_id" class="detmat_det_id">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-form-label" for="proc_nombre">{{ __('Lista de Materiales') }}: </label>
                            <table class="table table-sm">
                                <thead class="text-center" style="background-color: #BBEAF2">
                                    <th hidden>#</th>
                                    <th>{{ __('Nombre') }}</th>
                                    <th class="text-center">{{ __('Medida') }}</th>
                                    <th>Op</th>
                                </thead>
                            </table>
                            <div class="col-xl-12 col-sm-12 table-responsive table-bordered mt-0 pt-0" style="height: 300px;">
                                <table class="table table-sm table-hover tabla_lista_materiales" id="tabla_lista_materiales" >
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-sm-8" >
                        <div class="row justify-content-center" >
                            <div class="col-xl-11 col-sm-11 text-center">
                                <label class="col-form-label">{{ __('MATERIALES AGREGADOS') }}</label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-sm-12 ">
                                <table class="table table-sm table-bordered">
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
                            <div class="col-xl-12 col-sm-12 table-responsive table-borderless mt-0 pt-0" style="height: 320px">
                                <table class="table table-sm table-hover tabla_material_estudio" id="tabla_material_estudio" >
                                    
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xl-12 col-sm-12 mb-0 pb-0">
                                <table class="table table-sm table-bordered">
                                    <tfoot class="table-primary">
                                        <tr style="vertical-align: middle;">
                                            <td width="60px">{{ __('Estudio') }} </td>
                                            <td width="100px" class="text-right cld-precio-estudio"></td>
                                            <td width="30px">Bs</td>
                                            <td class="text-right">{{ __('Total') }} </td>
                                            <td width="100px" class="text-right cld-precio" ></td>
                                            <td width="30px">Bs</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right cld-precio-literal" ></td>
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