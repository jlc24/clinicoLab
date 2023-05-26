<div class="modal fade" id="modal_ver_cliente_{{ $cliente->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_ver_cliente_{{ $cliente->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #31D2F2; color: #fff">
                <h1 class="modal-title fs-5" id="modal_ver_cliente_{{ $cliente->id }}Label"><strong>{{ __('Datos del Paciente') }}</strong></h1>
                <button type="button" id="btnCloseUpClient" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-sm-5 pt-3 mr-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <img @if($cliente->cli_genero == 'MASCULINO')
                                    src="{{ asset('dist/img/avatar5.png') }}"
                                @elseif($cliente->cli_genero == 'FEMENINO')
                                    src="{{ asset('dist/img/avatar2.png') }}"
                                @endif width="150px" style="border-style: solid; border-radius: 50%">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Codigo') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $cliente->cli_cod }}</label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Usuario') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $cliente->cli_correo }}</label>
                            </div>
                            <h1 class="col-xl-4 col-sm-4 col-form-label">{{ __('Contraseña') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                <label class="col-form-label">{{ $cliente->cli_password }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 pt-2 ml-1" style="border-style: solid; border-width: 1px; border-radius: 10px; border-color: #C6C8CA">
                        <h3>Datos Personales</h3>
                        <div class="form-group row justify-content-center">
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Nombre') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $cliente->cli_nombre }} {{ $cliente->cli_apellido_pat }} {{ $cliente->cli_apellido_mat }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('C.I.') }}:</h1>
                            <div class="col-xl-4 col-sm-4">
                                <label class="col-form-label">{{ $cliente->cli_ci_nit }}</label>
                            </div>
                            <h1 class="col-xl-2 col-sm-2 col-form-label">{{ __('Exp.') }}:</h1>
                            <div class="col-xl-3 col-sm-3">
                                <label class="col-form-label">{{ $cliente->cli_exp_ci }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Fecha Nac.') }}:</h1>
                            <div class="col-xl-6 col-sm-6">
                                @php
                                    $espanol = setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
                                    $fechaNacimiento = new DateTime($cliente->cli_fec_nac);
                                    $fechaFormateada = strftime('%e de %B de %Y', $fechaNacimiento->getTimestamp());
                                @endphp
                                <label class="col-form-label">{{ $fechaFormateada }}</label>
                            </div>
                            <div class="col-xl-3 col-sm-3">
                                <label class="col-form-label">{{ $cliente->cli_edad }} años</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dirección') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $cliente->cli_direccion }}</label>
                            </div>
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Dep.') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $cliente->departamento->nombre }}</label>
                            </div>
                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Municipio') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $cliente->municipio->nombre }}</label>
                            </div>

                            <h1 class="col-xl-3 col-sm-3 col-form-label">{{ __('Celular') }}:</h1>
                            <div class="col-xl-9 col-sm-9">
                                <label class="col-form-label">{{ $cliente->cli_celular }}</label>
                                <label class="col-form-label"><a href="https://api.whatsapp.com/send?phone=591{{ $cliente->cli_celular }}" target="_blank" rel="noreferrer" style="color: #32C861" class="ml-4"><i class="fab fa-whatsapp fa-lg" ></i></a></label>
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