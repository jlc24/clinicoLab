<div class="modal fade" id="modal_actualizar_medida" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_medidaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC107; color: #000">
                <h1 class="modal-title fs-5" id="modal_actualizar_medidaLabel"><strong>{{ __('Modificar Unidad de Medida') }}</strong></h1>
                <button type="button" id="btnCloseUpMed" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form class="form-horizontal" id="formulario_actualizar_medida">
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_categoria_update">{{ __('Categoría') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <select id="medida_categoria_update" class="custom-select custom-select-sm medida_categoria_update" name="medida_categoria_update">
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
                                    </select>
                                    <input type="hidden" name="medida_id_update" id="medida_id_update" class="medida_id_update">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_nombre_update">{{ __('Nombre') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="medida_nombre_update" name="medida_nombre_update" class="form-control form-control-sm medida_nombre_update" autocomplete="off" placeholder="Nombre de medida" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="medida_unidad_update">{{ __('Unidad') }}:<span class="dato_requerido">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" id="medida_unidad_update" name="medida_unidad_update" class="form-control form-control-sm medida_unidad_update" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateMedida" class="btn btn-warning btnUpdateMedida" data-dismiss="modal">{{ __('Actualizar') }}</button>
            </div>
        </div>
    </div>
</div>