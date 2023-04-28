<div class="modal fade" id="modal_configurar_estudio_componente_{{ $detalle->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_configurar_estudio_componente_{{ $detalle->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #7EE2F0; color: #000">
                <h1 class="modal-title fs-5" id="modal_configurar_estudio_componente_{{ $detalle->id }}Label"><strong>{{ __('Estudio por Componentes') }}:</strong> {{ $detalle->estudio->est_nombre }}</h1>
                <input type="hidden" name="proc_est_id" id="proc_est_id">
                <input type="hidden" name="proc_id" id="proc_id">
                <button type="button" id="btnCloseUpEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-3 col-sm-3" style="display: flex">
                        <h3 class="col-form-label">{{ __('Procedimiento') }}:</h3>
                        <div style="margin-top: 0px; margin-left: 10px; padding-left: 7px; font-size: 25px;">
                            <a href="#" data-id="{{ $detalle->id }}" data-toggle="modal" data-target="#modal_crear_procedimiento" class="btn btn-sm btn-outline-success btn-config" title="Agregar procedimiento">
                                <i class="fas fa-plus-circle fa-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-2">

                    </div>
                    <div class="col-xl-7 col-sm-7">
                        <table class="table table-sm table-responsive-lg" id="tabla_detalle_proc">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" id="estudio_componente" style="display: none;">
                    <div class="col-xl-3 col-sm-3" style="display: flex">
                        <h3 class="col-form-label">{{ __('Procedimiento') }}:</h3>
                        <div style="margin-top: 0px; margin-left: 10px; padding-left: 7px; font-size: 25px;">
                            <a href="#" data-id="{{ $detalle->id }}" data-toggle="modal" data-target="#modal_crear_procedimiento" class="btn btn-sm btn-outline-success btn-config" title="Agregar procedimiento">
                                <i class="fas fa-plus-circle fa-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-2">

                    </div>
                    <div class="col-xl-7 col-sm-7">
                        <table class="table table-sm table-responsive-lg">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnEditEst" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </div>
</div>