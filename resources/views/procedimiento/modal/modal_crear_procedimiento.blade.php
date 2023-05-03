<div class="modal fade" id="modal_crear_procedimiento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_procedimientoLabel" aria-hidden="true">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_procedimientoLabel"><strong>{{ __('Agregar Procedimiento') }}</strong></h1>
                <button type="button" id="btnCloseAddProc" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="row" style="border: 1px solid #C6C8CA; border-radius: 5px;">
                    <div class="col-xl-12 col-sm-12">
                            <label class="col-form-label" for="proc_nombre">{{ __('Lista de Procedimientos') }}: </label>
                            <input type="hidden" name="det_id_proc" id="det_id_proc">
                            <input type="hidden" name="proc_tipo_estudio" id="proc_tipo_estudio" class="proc_tipo_estudio">
                    </div>
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-bordered table-responsive-lg" id="tabla_procedimiento">
                            <thead class="text-center">
                                <th hidden>#</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>Op</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <form class="form-horizontal" id="formulario_crear_procedimiento">
                    <div class="row">
                        <label class="col-form-label">{{ __('Crear procedimiento') }}</label>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label" for="proc_nombre">{{ __('Procedimiento') }}: </label>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-9" >
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="proc_nombre" name="proc_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Componente" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="form-group">
                                <label class="col-form-label" for="proc_nombre">{{ __('Metodología') }}: </label>
                            </div>
                        </div>
                        <div class="col-xl-9 col-sm-9" >
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <select class="custom-select custom-select-sm" name="proc_metodo" id="proc_metodo" required>
                                        <option value="" selected disabled>Seleccionar</option>
                                        @foreach ($metodos as $metodo)
                                            <option value="{{ $metodo->id }}">{{ $metodo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnRegisterProc" class="btn btn-success">{{ __('Registrar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>