<div class="modal fade" id="modal_crear_metodologia" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_metodologiaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_metodologiaLabel"><strong>{{ __('Agregar Metodologias') }}</strong></h1>
                <button type="button" id="btnCloseAddMetodo" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_crear_metodo">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="metodo_nombre">{{ __('Nombre') }}: <span class="dato_requerido">*</span> </label>
                                <div class="col-md-8">
                                    <input type="text" id="metodo_nombre" name="metodo_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre metodo" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="metodo_descripcion">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="metodo_descripcion" id="metodo_descripcion" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); opcional($(this))"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnRegisterMetodo" class="btn btn-success">{{ __('Registrar') }}</button>
            </div>
        </div>
    </div>
</div>