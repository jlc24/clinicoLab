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

                <form action="{{ route('componente') }}" method="POST" class="form-horizontal" id="formulario_crear_componentes">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="comp_nombre">{{ __('Nombre del Componente') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" id="comp_nombre" name="comp_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Componente" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnRegisterComp" class="btn btn-success">{{ __('Registrar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>