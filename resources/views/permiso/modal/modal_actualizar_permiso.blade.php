<div class="modal fade" id="modal_actualizar_permiso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_permisoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_permisoLabel"><strong>{{ __('Actualizar Permisos') }}</strong></h1>
                <button type="button" id="btnCloseAddPermiso" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <form class="form-horizontal" id="formulario_actualizar_permiso">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="permiso_desc_update">{{ __('Descripción') }}: </label>
                                <div class="col-md-9">
                                    <input type="text" id="permiso_desc_updatec" name="permiso_desc_update" class="form-control form-control-sm permiso_desc_update" autocomplete="off" placeholder="descripcion" pattern="[a-zA-Z ]*" required>
                                    <input type="hidden" name="permiso_id" id="permiso_id" class="permiso_id">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 text-right">
                            <button id="btnUpdatePermiso" class="btn btn-success btnUpdatePermiso">{{ __('Actualizar') }}</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>