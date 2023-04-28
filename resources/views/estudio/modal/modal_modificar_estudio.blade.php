<div class="modal fade" id="modal_editar_estudio_{{ $detalle->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_editar_estudio_{{ $detalle->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_editar_estudio_{{ $detalle->id }}Label"><strong>{{ __('Modificar Estudio o Análisis') }}</strong></h1>
                <button type="button" id="btnCloseUpEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('estudios/'.$detalle->estudio->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_estudio">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_cod_update">{{ __('Clave') }}:</label>
                                <div class="col-md-5" style="display: inline-flex;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px;"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" value="{{ $detalle->estudio->est_cod }}" id="est_cod_update" name="est_cod_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_clave_est_update" name="generar_clave_est_update" title="Generar Clave"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_nombre_update">{{ __('Nombre Estudio') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $detalle->estudio->est_nombre }}" id="est_nombre_update" name="est_nombre_update" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_descripcion_update">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="est_descripcion_update" id="est_descripcion_update" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); ">{{ $detalle->estudio->est_descripcion }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_muestra_update">{{ __('Tipo de Muestra') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="est_muestra_update" name="est_muestra_update" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        @foreach ($muestras as $muestra)
                                            <option value="{{ $muestra->id }}" 
                                                @if($muestra->id == $detalle->muestra_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $muestra->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_recipiente_update">{{ __('Recipiente') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="est_recipiente_update" name="est_recipiente_update">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        @foreach ($recipientes as $recipiente)
                                            <option value="{{ $recipiente->id }}"
                                                @if($recipiente->id == $detalle->recipiente_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $recipiente->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_indicaciones_update">{{ __('Indicaciones') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="est_indicaciones_update" name="est_indicaciones_update">
                                        <option value="" selected="">SELECCIONAR...</option>
                                        @foreach ($indicaciones as $indicacion)
                                            <option value="{{ $indicacion->id }}"
                                                @if($indicacion->id == $detalle->indicacion_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >{{ $indicacion->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="est_precio_update">{{ __('Precio') }}: </label>
                                <div class="col-md-5">
                                    <input type="number" min="0" step="0.01" value="{{ $detalle->estudio->est_precio }}" id="est_precio_update" name="est_precio_update" class="form-control form-control-sm" autocomplete="off" required>
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select custom-select-sm" id="est_moneda_update" name="est_moneda_update" required>
                                        @if($detalle->estudio->est_moneda == 'Bs')
                                            <option value="Bs" selected>Bs</option>
                                            <option value="$">$</option>
                                        @else
                                            <option value="$" selected>$</option>
                                            <option value="Bs">Bs</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnEditEst" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>