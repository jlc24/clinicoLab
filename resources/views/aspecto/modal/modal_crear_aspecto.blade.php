<div class="modal fade" id="modal_crear_aspecto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_aspectoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #000">
                <h1 class="modal-title fs-5 lblComponente" id="modal_crear_aspectoLabel"></h1>
                <button type="button" id="btnCloseAddAspecto" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                    <div class="row lista_aspectos" >
                        <div class="col-xl-4 col-sm-12" style="border: 1px solid #b2b3b4; border-radius: 5px; box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);">
                            <form class="form-horizontal" id="formulario_crear_aspectos">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12" >
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label" for="asp_nombre">{{ __('Nombre') }}: </label>
                                            <div class="col-md-12">
                                                <input type="text" id="asp_nombre" name="asp_nombre" class="form-control form-control-sm asp_nombre" autocomplete="off" placeholder="Nombre Prueba" required>
                                                <input type="hidden" name="dp_comp_id" id="dp_comp_id" class="dp_comp_id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-sm-12 text-right">
                                        <button id="btnRegisterAsp" class="btn btn-sm btn-success">{{ __('Agregar') }}</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <label class="col-form-label" for="proc_nombre">{{ __('Lista de Pruebas') }}: </label>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <table class="table table-sm mb-0 pb-0">
                                        <thead class="text-center" style="background-color: #BBEAF2">
                                            <th hidden>#</th>
                                            <th>{{ __('Nombre') }}</th>
                                            <th>Op</th>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-xl-12 col-sm-12 table-responsive table-bordered" style="height: 300px;">
                                    <table class="table table-sm table-hover tabla_aspectos" id="tabla_aspectos" >
                                        
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-sm-12" >
                            <div class="row justify-content-center" >
                                <div class="col-xl-11 col-sm-11 text-center">
                                    <label class="col-form-label">{{ __('PRUEBAS A EVALUAR') }}</label>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-10 col-sm-12 ">
                                    <table class="table table-sm mb-0 pb-0">
                                        <thead style="background-color: #BAECCA;">
                                            <th width="50px"></th>
                                            <th hidden>#</th>
                                            <th width="180px">Prueba</th>
                                            <th class="text-center" width="100px">Unidad</th>
                                            <th class="text-center">Parámetro</th>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-xl-10 col-sm-12 table-responsive table-borderless" style="height: 420px">
                                    <table class="table table-sm table-hover tabla_dpc_parametro" id="tabla_dpc_parametro" >
                                        
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>