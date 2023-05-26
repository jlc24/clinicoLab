<div class="modal fade" id="modal_ver_medico_{{ $medico->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_medico_{{ $medico->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_medico_{{ $medico->id }}Label"><strong>{{ __('Datos del Médico') }}</strong></h1>
                <button type="button" id="btnCloseUpClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-5 pt-3 mr-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('dist/img/avatar5.png') }}" width="150px" style="border-style: solid; border-radius: 50%">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Codigo') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $medico->med_cod }}</label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Usuario') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $medico->med_correo }}</label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Contraseña') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $medico->med_password }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pt-2 ml-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <h3>Datos Personales</h3>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Nombre') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->med_nombre }} {{ $medico->med_apellido_pat }} {{ $medico->med_apellido_mat }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Esp.') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->med_especialidad }}</label>
                            </div>
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('C.I.') }}:</h1>
                            <div class="col-xl-4 col-sm-4">
                                <label class="col-form-label">{{ $medico->med_ci_nit }}</label>
                            </div>
                            <h1 class="col-xl-2 col-sm-2 col-form-label">{{ __('Exp.') }}:</h1>
                            <div class="col-xl-3 col-sm-3">
                                <label class="col-form-label">{{ $medico->med_exp_ci }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dirección') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->med_direccion }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dep.') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->departamento->nombre }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Municipio') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->municipio->nombre }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Celular') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $medico->med_celular }}</label>
                                <label class="col-form-label"><a href="https://api.whatsapp.com/send?phone=591{{ $medico->med_celular }}" target="_blank" rel="noreferrer" style="color: #32C861" class="ml-4"><i class="fab fa-whatsapp fa-lg" ></i></a></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button id="btnShowClient" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>