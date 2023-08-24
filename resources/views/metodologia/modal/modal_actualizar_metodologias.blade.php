<div class="modal fade" id="modal_actualizar_metodologia" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_metodologiaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_metodologiaLabel"><strong>{{ __('Modificar Metodologias') }}</strong></h1>
                <button type="button" id="btnCloseUpMetodo" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_actualizar_metodo">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="metodo_nombre_update">{{ __('Nombre metodo') }}: </label>
                                <div class="col-md-8">
                                    <input type="hidden" name="metodo_id_update" id="metodo_id_update" class="metodo_id_update">
                                    <input type="text" id="metodo_nombre_update" name="metodo_nombre_update" class="form-control form-control-sm metodo_nombre_update" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="metodo_descripcion_update">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm metodo_descripcion_update" name="metodo_descripcion_update" id="metodo_descripcion_update" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateMetodo" class="btn btn-success btnUpdateMetodo">{{ __('Actualizar') }}</button>
            </div>
        </div>
    </div>
</div>