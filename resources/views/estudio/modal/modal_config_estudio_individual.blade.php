<div class="modal fade" id="modal_configurar_estudio_individual_{{ $detalle->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_configurar_estudio_individual_{{ $detalle->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #7EE2F0; color: #000">
                <h1 class="modal-title fs-5" id="modal_configurar_estudio_individual_{{ $detalle->id }}Label"><strong>{{ __('Configuración') }}:</strong> {{ $detalle->estudio->est_nombre }}</h1>
                <input type="hidden" name="proc_est_tipo_estudio" id="proc_est_tipo_estudio" class="proc_est_tipo_estudio">
                <input type="hidden" name="proc_est_id" id="proc_est_id" class="proc_est_id">
                <input type="hidden" name="proc_est_nombre" id="proc_est_nombre" class="proc_est_nombre">
                <input type="hidden" name="proc_id" id="proc_id" class="proc_id">
                <button type="button" id="btnCloseUpEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-sm-12 pt-1" style="background-color: #28A745;">
                        <label class="col-md-12 col-form-label" style="color: #fff">
                            <a href="#" data-id="{{ $detalle->id }}" data-toggle="modal" data-target="#modal_crear_procedimiento" class="btn-config" title="Agregar procedimiento" style="color: #fff">
                                <i class="fas fa-plus-circle fa-lg"></i>
                            </a>{{ __(' Procedimientos') }}:
                        </label>
                    </div>
                    <div class="col-xl-12 col-sm-12 table-responsive-lg">
                        <table class="table table-sm table-borderless tabla_detalle_proc" id="tabla_detalle_proc">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center datos_componentes" style="display: none;">
                    <div class="col-xl-12 col-sm-12 pt-1" style="background-color: #7EE2F0;">
                        <label class="col-md-12 col-form-label">
                            <a href="#" data-id="{{ $detalle->id }}" data-toggle="modal" data-target="#modal_crear_componente" class=" btn-add-comp" title="Agregar componente">
                                <i class="fas fa-plus-circle fa-lg"></i>
                            </a>{{ __('Componentes') }}:
                        </label>
                        <input type="hidden" name="dp_id" id="dp_id" class="dp_id">
                    </div>
                    <div class="col-xl-12 col-sm-12 table-responsive-lg"><br>
                        <table class="table table-striped table-sm text-center tabla_proc_comp" id="tabla_proc_comp">
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnEditEst" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </div>
</div>