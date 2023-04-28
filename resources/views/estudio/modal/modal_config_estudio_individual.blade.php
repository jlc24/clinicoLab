<div class="modal fade" id="modal_configurar_estudio_individual_{{ $detalle->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_configurar_estudio_individual_{{ $detalle->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #000">
                <h1 class="modal-title fs-5" id="modal_configurar_estudio_individual_{{ $detalle->id }}Label"><strong>{{ __('Estudio individual') }}:</strong> {{ $detalle->estudio->est_nombre }}</h1>
                <input type="hidden" name="proc_est_id" id="proc_est_id" class="proc_est_id">
                <input type="hidden" name="proc_est_nombre" id="proc_est_nombre" class="proc_est_nombre">
                <input type="hidden" name="proc_id" id="proc_id" class="proc_id">
                <button type="button" id="btnCloseUpEstudio" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-1 col-sm-1">
                        <a href="#" data-id="{{ $detalle->id }}" data-toggle="modal" data-target="#modal_crear_procedimiento" class="btn btn-sm btn-outline-success btn-config" title="Agregar procedimiento">
                            <i class="fas fa-plus-circle fa-lg"></i>
                        </a>
                    </div>
                    <div class="col-xl-2 col-sm-2 text-right">
                        <div class="form-group row">
                            <label class="col-md-12 col-form-label">{{ __(' Procedimientos') }}:</label>
                        </div>
                    </div>
                    <div class="col-xl-8 col-sm-8">
                        <table class="table table-sm table-responsive-lg" id="tabla_detalle_proc">
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-sm-8">
                        <label class="col-md-12 col-form-label" for="est_nombre">{{ __('Componentes') }}: </label>
                        <table class="table table-borderless table-sm table-responsive-lg text-center tabla_proc_comp" id="tabla_proc_comp">
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