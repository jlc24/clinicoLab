<div class="modal fade" id="modal_crear_medida" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_medidaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_medidaLabel"><strong>{{ __('Agregar Unidad de Medida') }}</strong></h1>
                <button type="button" id="btnCloseAddMedida" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form id="formulario_crear_medida">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_categoria">{{ __('Categoría') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <select id="medida_categoria" class="custom-select custom-select-sm medida_categoria" name="medida_categoria" onchange="obligado($(this))">
                                        <option value="" selected disabled>Seleccionar...</option>
                                        <option value="Longitud">Longitud</option>
                                        <option value="Volumen">Volumen</option>
                                        <option value="Masa">Masa</option>
                                        <option value="Tiempo">Tiempo</option>
                                        <option value="Presion">Presion</option>
                                        <option value="Temperatura">Temperatura</option>
                                        <option value="Concentracion">Concentracion</option>
                                        <option value="Luminosidad o Intensidad Luminosa">Luminosidad o Intensidad Luminosa</option>
                                        <option value="Velocidad de sedimentación globular (VSG o VHS)">Velocidad de sedimentación globular (VSG o VHS)</option>
                                        <option value="Electrolitos y Sustancias Químicas">Electrolitos y Sustancias Químicas</option>
                                        <option value="Enzimas y Marcadores">Enzimas y Marcadores</option>
                                        <option value="Otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_nombre">{{ __('Nombre') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="medida_nombre" name="medida_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre de medida" onkeyup="obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_unidad">{{ __('Unidad') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="medida_unidad" name="medida_unidad" class="form-control form-control-sm" autocomplete="off" placeholder="Ej: m, L, mg/dl, ml, mu" onkeyup="obligado($(this))" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnRegisterMed" class="btn btn-success">{{ __('Registrar') }}</button>
            </div>
        </div>
    </div>
</div>