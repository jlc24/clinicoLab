<div class="modal fade" id="modal_ver_cliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_clienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_clienteLabel"><strong>{{ __('Datos del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseShowClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-5 pt-3 mr-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <img src="" class="img-perfil-cliente" width="150px" style="border-style: solid; border-radius: 50%">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Codigo') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label cli_cod"></label>
                                <input type="hidden" name="cli_id" id="cli_id" class="cli_id">
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Usuario') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label cli_correo"></label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Contraseña') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label cli_password"></label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Estado') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label cli_estado ">
                                        <a href="javascript:void(0);" class=" cli_estado_color">
                                        </a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pt-2 ml-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <h3>{{ __('Datos Personales') }}</h3>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Nombre') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label cli_nombre"></label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('C.I.') }}:</h1>
                            <div class="col-xl-4 col-sm-4">
                                <label class="col-form-label cli_ci"></label>
                            </div>
                            <h1 class="col-xl-2 col-sm-2 col-form-label">{{ __('Exp.') }}:</h1>
                            <div class="col-xl-3 col-sm-3">
                                <label class="col-form-label cli_exp"></label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Fecha Nac.') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label cli_fec_nac"></label>
                            </div>
                            <div class="col-xl-3 col-sm-3">
                                <label class="col-form-label cli_edad"></label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dirección') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label cli_direccion"></label>
                            </div>
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dep.') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label cli_dep"></label>
                            </div>
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Municipio') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label cli_mun"></label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Celular') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label cli_num_celular"></label>
                                @if(Auth::user()->rol == 'admin')
                                    <label class="col-form-label"><a href="" target="_blank" rel="noreferrer" style="color: #32C861" class="ml-4 cli_celular"><i class="fab fa-whatsapp fa-2x"></i></a></label>
                                @else
                                    <label class="col-form-label cli_celular"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnShowClient" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>