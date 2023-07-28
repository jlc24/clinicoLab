<div class="modal fade" id="modal_actualizar_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_materialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_actualizar_materialLabel"><strong>{{ __('Modificar Material') }}</strong></h1>
                <button type="button" id="btnCloseUpMaterial" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xl-12 col-sm-12">
                    <form class="form-horizontal" id="formulario_materiales">
                        <div class="form-group row" hidden>
                            <label class="col-md-3 col-form-label ui-front" for="mat_cod_update">{{ __('Cod.') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="text" id="mat_cod_update" name="mat_cod_update" class="form-control form-control-sm mat_cod_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_nombre_update">{{ __('Nombre') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="text" id="mat_nombre_update" name="mat_nombre_update" class="form-control form-control-sm mat_nombre_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                <input type="hidden" name="mat_id_update" id="mat_id_update" class="mat_id_update">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_descripcion_update">{{ __('Descripción') }}:</label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <textarea name="mat_descripcion_update" id="mat_descripcion_update" rows="3" class="form-control form-control-sm mat_descripcion_update"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_categoria_update">{{ __('Categoria') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <select id="mat_categoria_update" name="mat_categoria_update" class="custom-select custom-select-sm mat_categoria_update" >
                                    <option value="" selected>Seleccionar...</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_imagen_update">{{ __('Imagen') }}:</label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="file" name="mat_imagen_update" id="mat_imagen_update" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file mat_imagen_update" onchange="VerImagen('mat_imagen_update', 'img_material_update')">
                            </div>
                            <div class="col-md-12 text-center">
                                <small><span style="color: red;" id="error_med_nombre">(Tamaño máximo aprox. 2mb)</span></small>
                            </div>
                            <div class="col-md-12 text-center mt-2">
                                <img src="" id="img_material_update" class="img_material_update" width="100px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning btnUpdateMaterial" id="btnUpdateMaterial">Actualizar</button>
            </div>
        </div>
    </div>
</div>