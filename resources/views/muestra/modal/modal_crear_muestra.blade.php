<div class="modal fade" id="modal_crear_muestra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_muestraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_muestraLabel"><strong>{{ __('Agregar Muestra') }}</strong></h1>
                <button type="button" id="btnCloseAddMuestra" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_crear_muestra">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="muestra_nombre">{{ __('Nombre Muestra') }}:<span class="dato_requerido">*</span> </label>
                                <div class="col-md-8">
                                    <input type="text" id="muestra_nombre" name="muestra_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Muestra" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="muestra_descripcion">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="muestra_descripcion" id="muestra_descripcion" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnRegisterMuestra" class="btn btn-success" >{{ __('Registrar') }}</button>
            </div>
        </div>
    </div>
</div>