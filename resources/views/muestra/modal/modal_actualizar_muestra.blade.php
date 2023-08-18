<div class="modal fade" id="modal_actualizar_muestra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_muestraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_actualizar_muestraLabel"><strong>{{ __('Modificar Muestra') }}</strong></h1>
                <button type="button" id="btnCloseUpMuestra" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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

                <form class="form-horizontal" id="formulario_actualizar_muestra">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="muestra_nombre_update">{{ __('Nombre Muestra') }}: <span class="dato_requerido">*</span> </label>
                                <div class="col-md-8">
                                    <input type="text" id="muestra_nombre_update" name="muestra_nombre_update" class="form-control form-control-sm muestra_nombre_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                    <input type="hidden" name="muestra_id_update" id="muestra_id_update" class="muestra_id_update">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="muestra_descripcion_update">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm muestra_descripcion_update" name="muestra_descripcion_update" id="muestra_descripcion_update" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateMuestra" class="btn btn-warning btnUpdateMuestra">{{ __('Actualizar') }}</button>
            </div>
        </div>
    </div>
</div>