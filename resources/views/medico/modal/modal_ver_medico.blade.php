<div class="modal fade" id="modal_ver_medico_{{ $medico->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_medico_{{ $medico->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_medico_{{ $medico->id }}Label"><strong>{{ __('Datos del Médico') }}</strong></h1>
                <button type="button" id="btnCloseShowMedico" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-5 pt-3 mr-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <img @if($medico->med_genero == 'MASCULINO')
                                        src="{{ asset('dist/img/avatar5.png') }}"
                                    @elseif($medico->med_genero == 'FEMENINO')
                                        src="{{ asset('dist/img/avatar2.png') }}"
                                    @endif width="150px" style="border-style: solid; border-radius: 50%">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Codigo') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $medico->med_cod }}</label>
                                <input type="hidden" name="med_id_show" id="med_id_show" class="med_id_show">
                            </div>
                            @if(Auth::user()->rol == 'admin')
                                <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Usuario') }}:</h1>
                                <div class="col-xl-6 col-sm-6">
                                    <label class="col-form-label">{{ $medico->med_correo }}</label>
                                </div>
                                <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Password') }}:</h1>
                                <div class="col-xl-6 col-sm-6">
                                    <label class="col-form-label">{{ $medico->med_password }}</label>
                                </div>
                            @else
                                <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Usuario') }}:</h1>
                                <div class="col-xl-6 col-sm-6">
                                    <label class="col-form-label">*******************</label>
                                </div>
                                <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Contraseña') }}:</h1>
                                <div class="col-xl-6 col-sm-6">
                                    <label class="col-form-label">*******************</label>
                                </div>
                            @endif
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Estado') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                @if($medico->user->estado == 1)
                                    <span class="badge badge-success">ACTIVO</span>
                                @else
                                <span class="badge badge-danger">INACTIVO</span>
                                @endif
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
                                <label class="col-form-label">
                                    @if($medico->departamento !== null)
                                        {{ $medico->departamento->nombre }}
                                    @endif
                                </label>
                            </div>

                            <h1 class="col-xl-3 col-sm-12 col-form-label">{{ __('Municipio') }}:</h1>
                            <div class="col-xl-9 col-sm-12">
                                <label class="col-form-label">
                                    @if($medico->municipio !== null)
                                        {{ $medico->municipio->nombre }}
                                    @endif
                                </label>
                            </div>

                            <h1 class="col-xl-3 col-sm-12 col-form-label">{{ __('Celular') }}:</h1>
                            <div class="col-xl-9 col-sm-12">
                                <label class="col-form-label">{{ $medico->med_celular }}</label>
                                <label class="col-form-label"><a href="https://api.whatsapp.com/send?phone=591{{ $medico->med_celular }}" target="_blank" rel="noreferrer" style="color: #32C861" class="ml-4"><i class="fab fa-whatsapp fa-lg" ></i></a></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-sm-12 pt-2 mt-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA; display: inline-flex">
                        <div class="col-xl-7 col-sm-12">
                            <div class="form-group row ">
                                <h1 class="col-xl-5 col-sm-12 col-form-label">{{ __('Convenio') }}:</h1>
                                <div class="col-xl-7 col-sm-12">
                                    <label class="col-form-label">{{ $medico->med_convenio }} %</label>
                                </div>
                                <h1 class="col-xl-5 col-sm-12 col-form-label">{{ __('Banco') }}:</h1>
                                <div class="col-xl-7 col-sm-12">
                                    <label class="col-form-label">{{ $medico->med_banco }}</label>
                                </div>
                                <h1 class="col-xl-5 col-sm-12 col-form-label">{{ __('Cuenta') }}:</h1>
                                <div class="col-xl-7 col-sm-12">
                                    <label class="col-form-label">{{ $medico->med_cuenta }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-12" style="display: inline-flex">
                            <h1 class="col-xl-3 col-sm-12 col-form-label">{{ __('QR') }}:</h1>
                            <div class="col-xl-8 col-sm-12 text-center" >
                                <a href="javascript:void(0);" title="Ver Imagen" @if($medico->med_qr !== null) data-toggle="modal" data-target="#modal_qr_show" @endif  class="btnVerQr">
                                    @if($medico->med_qr == null)
                                        <img src="{{ asset('dist/img/default.png') }}" class="imageQR" id="imageQR" width="100px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                                    @else
                                        <img src="{{ asset('storage/'.$medico->med_qr) }}" class="imageQR" id="imageQR" width="100px" style="border: 2px solid rgb(146, 144, 144); border-radius: 10px; box-shadow: 2px 2px 4px 2px rgba(0, 0, 0, 0.3);">
                                    @endif
                                </a>
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