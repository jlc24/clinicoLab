<div class="modal fade" id="modal_crear_permiso" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_permisoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_permisoLabel"><strong>{{ __('Agregar Permisos') }}</strong></h1>
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
                <form class="form-horizontal" id="formulario_crear_permiso">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="permiso_desc">{{ __('Descripción') }}: </label>
                                <div class="col-md-9">
                                    <input type="text" id="permiso_desc" name="permiso_desc" class="form-control form-control-sm permiso_desc" autocomplete="off" placeholder="descripcion" pattern="[a-zA-Z ]*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12 text-right">
                            <button id="btnRegisterPermiso" class="btn btn-success btnRegisterPermiso">{{ __('Agregar') }}</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>