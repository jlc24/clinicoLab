<div class="modal fade" id="modal_crear_material" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_materialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_materialLabel"><strong>{{ __('Agregar Material') }}</strong></h1>
                <button type="button" id="btnCloseAddMaterial" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                            <label class="col-md-3 col-form-label ui-front" for="mat_cod">{{ __('Cod.') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="text" placeholder="Codigo Material" id="mat_cod" name="mat_cod" class="form-control form-control-sm mat_cod" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_nombre">{{ __('Nombre') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="text" placeholder="Nombre Material" id="mat_nombre" name="mat_nombre" class="form-control form-control-sm mat_nombre" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_descripcion">{{ __('Descripción') }}:</label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <textarea name="mat_descripcion" id="mat_descripcion" rows="3" class="form-control form-control-sm mat_descripcion"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_categoria">{{ __('Categoria') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <select id="mat_categoria" name="mat_categoria" class="custom-select custom-select-sm mat_categoria" style="border-radius: 5px 0px 0px 5px;" >
                                    <option value="" selected>Seleccionar...</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="vidaUtil" hidden>
                            <label class="col-md-3 col-form-label" for="mat_vida_util">{{ __('Vida Util') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="number" placeholder="AÑOS" id="mat_vida_util" name="mat_vida_util" class="form-control form-control-sm mat_vida_util" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group row" id="depreciacion" hidden>
                            <label class="col-md-3 col-form-label" for="mat_depreciacion">{{ __('Depreciacion') }}:<span class="dato_requerido">*</span></label>
                            <div class="col-md-5">
                                <input type="number" min="0" step="0.01" id="mat_depreciacion" name="mat_depreciacion" class="form-control form-control-sm mat_depreciacion" autocomplete="off" required>
                            </div>
                            <div class="col-md-4">
                                <select id="mat_categoria" name="mat_categoria" class="custom-select custom-select-sm mat_categoria" style="border-radius: 5px 0px 0px 5px;" disabled>
                                    <option value="%" selected>%</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="mat_imagen">{{ __('Imagen') }}:</label>
                            <div class="col-md-9" style="display: inline-flex;">
                                <input type="file" name="mat_imagen" id="mat_imagen" accept=".jpge,.jpg,image/png" class="form-control form-control-sm form-control-file mat_imagen" onchange="VerImagen('mat_imagen', 'img_material')">
                            </div>
                            <div class="col-md-12 text-center">
                                <small><span style="color: red;" id="error_med_nombre">(Tamaño máximo aprox. 2mb)</span></small>
                            </div>
                            <div class="col-md-12 text-center mt-2">
                                <img src="{{ asset('dist/img/default.png') }}" id="img_material" class="img_material" width="100px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btnRegisterMaterial" id="btnRegisterMaterial">Registrar</button>
            </div>
        </div>
    </div>
</div>