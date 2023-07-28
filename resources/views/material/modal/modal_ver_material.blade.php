<div class="modal fade" id="modal_ver_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_materialLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0DCAF0; color: #000">
                <h1 class="modal-title fs-5 modal_ver_materialLabel" id="modal_ver_materialLabel"></h1>
                <button type="button" id="btnCloseVerMaterial" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-sm-3">
                        <img src="" id="show_img_material" class="show_img_material" width="180px"  style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <div class="form-group row" hidden>
                            <label class="col-md-4 col-form-label" for="show_mat_cod">{{ __('Cod.') }}:</label>
                            <div class="col-md-8">
                                <input type="text" id="show_mat_cod" name="show_mat_cod" class="form-control form-control-sm show_mat_cod" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="show_mat_categoria">{{ __('Categoría') }}:</label>
                            <div class="col-md-6">
                                <select id="show_mat_categoria" name="show_mat_categoria" class="custom-select show_mat_categoria" disabled>
                                    <option value="" selected>Seleccionar...</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="show_mat_nombre">{{ __('Nombre') }}:</label>
                            <div class="col-md-8">
                                <input type="text" id="show_mat_nombre" name="show_mat_nombre" class="form-control form-control-sm show_mat_nombre" autocomplete="off" readonly>
                                <input type="hidden" name="show_mat_id" id="show_mat_id" class="show_mat_id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="show_mat_unidad">{{ __('Unidad') }}:</label>
                            <div class="col-md-4">
                                <select id="show_mat_unidad" name="show_mat_unidad" class="custom-select show_mat_unidad" disabled>
                                    <option value="" selected>Seleccionar...</option>
                                    @foreach ($medidas as $medida)
                                        <option value="{{ $medida->id }}">{{ $medida->unidad }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-responsive-lg  table-bordered tabla_compra_actual" id="tabla_compra_actual">
                            <thead class="table-info">
                                <th width="100px">ID</th>
                                <th>{{ __('Cantidad') }}</th>
                                <th>{{ __('Precio Compra') }}</th>
                                <th>{{ __('Precio Unitario') }}</th>
                                <th>{{ __('Cantidad Actual') }}</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <h4 for="mat_nombre">{{ __('Lista de compras realizadas') }}:</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 table-bordered table-responsive col-sm-12" style="height: 200px;">
                        <table class="table table-sm table-hover  tabla_compras_realizadas" id="tabla_compras_realizadas" >
                            <thead class="table-info">
                                <th >#</th>
                                <th>{{ __('Unidad') }}</th>
                                <th hidden>{{ __('umed_id') }}</th>
                                <th>{{ __('Cantidad') }}</th>
                                <th>{{ __('Precio Compra') }}</th>
                                <th>{{ __('Precio Unitario') }}</th>
                                <th>{{ __('Fecha Vencimiento') }}</th>
                                <th>Op</th>
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