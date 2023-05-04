<div class="modal fade" id="modal_crear_componente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_componenteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_componenteLabel"><strong>{{ __('Agregar Componentes') }}</strong></h1>
                <button type="button" id="btnCloseAddComponente" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                <div class="row lista_componentes" style="border: 1px solid #C6C8CA; border-radius: 5px; display: none;">
                    <div class="col-xl-12 col-sm-12">
                            <label class="col-form-label" for="proc_nombre">{{ __('Lista de Componentes') }}: </label>
                            <input type="" name="det_proc_id" id="det_proc_id" class="det_proc_id">
                            <input type="hidden" name="nombre_estudio" id="nombre_estudio" class="nombre_estudio">
                    </div>
                    <div class="col-xl-12 col-sm-12">
                        <table class="table table-sm table-bordered table-responsive-lg tabla_componentes" id="tabla_componentes">
                            <thead class="text-center">
                                <th >#</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>Op</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <form class="form-horizontal" id="formulario_crear_componentes">
                    
                    <div class="row">
                        <label class="col-form-label">{{ __('Crear Componente') }}</label>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="comp_nombre">{{ __('Componente') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" id="comp_nombre" name="comp_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Componente" pattern="[a-zA-Z ]+" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnRegisterComp" class="btn btn-success">{{ __('Agregar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>