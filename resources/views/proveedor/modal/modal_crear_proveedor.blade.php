<div class="modal fade" id="modal_crear_proveedor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_proveedorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_proveedorLabel"><strong>{{ __('Agregar Proveedor') }}</strong></h1>
                <button type="button" id="btnCloseAddProveedor" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="row">
                    <form class="form-horizontal" id="formulario_crear_proveedores">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_nombre">{{ __('Nombre Completo') }}:</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Nombres" id="prov_nombre" name="prov_nombre" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_empresa">Empresa:</label>
                                    <div class="col-md-5">
                                        <select class="custom-select custom-select-sm" id="prov_empresa" name="prov_empresa" >
                                            <option value="" selected="" disabled>SELECCIONAR...</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id }}">{{ $empresa->emp_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-md-1 col-form-label" for="prov_nit">NIT: </label>
                                    <div class="col-md-3">
                                        <input type="number" min="0" id="prov_nit" name="prov_nit" class="form-control form-control-sm" autocomplete="off" placeholder="NIT" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_direccion">{{ __('Dirección') }}:</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Direccion" id="prov_direccion" name="prov_direccion" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_email">{{ __('Correo Electrónico') }}:</label>
                                    <div class="col-md-5">
                                        <input type="email" placeholder="Email" id="prov_email" name="prov_email" class="form-control form-control-sm" autocomplete="off" required>
                                    </div>
                                    <label class="col-md-2 col-form-label" for="prov_telefono">Telefono: </label>
                                    <div class="col-md-2">
                                        <input type="number" min="0" id="prov_telefono" name="prov_telefono" class="form-control form-control-sm" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_web">{{ __('Direción WEB') }}:</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="WEB" id="prov_web" name="prov_web" class="form-control form-control-sm" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_descripcion">{{ __('Descripción') }}:</label>
                                    <div class="col-md-9">
                                        <textarea name="prov_descripcion" id="prov_descripcion" rows="3" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-10">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="prov_notas">{{ __('Notas') }}:</label>
                                    <div class="col-md-9">
                                        <textarea name="prov_notas" id="prov_notas" rows="3" class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success btnRegistrarProveedor">Registrar</button>
            </div>
        </div>
    </div>
</div>