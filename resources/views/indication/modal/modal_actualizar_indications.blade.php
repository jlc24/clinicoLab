<div class="modal fade" id="modal_actualizar_indicacion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_indicacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_indicacionLabel"><strong>{{ __('Agregar Indicaciones') }}</strong></h1>
                <button type="button" id="btnCloseUpIndicacion" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_actualizar_indicaciones">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="indi_descripcion_update">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="indi_id_update" id="indi_id_update" class="indi_id_update">
                                    <textarea class="form-control form-control-sm indi_descripcion_update" name="indi_descripcion_update" id="indi_descripcion_update" cols="35" rows="3" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnUpdateIndicacion" class="btn btn-success btnUpdateIndicacion">{{ __('Actualizar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>