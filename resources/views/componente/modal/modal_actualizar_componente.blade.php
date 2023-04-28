<div class="modal fade" id="modal_actualizar_componente_{{ $componente->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_componente_{{ $componente->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_componente_{{ $componente->id }}Label"><strong>{{ __('Modificar Componente') }}</strong></h1>
                <button type="button" id="btnCloseUpComp" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('componentes', $componente->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_componente">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="comp_nombre_update">{{ __('Nombre del Componente') }}: </label>
                                <div class="col-md-8" style="padding-top: 15px">
                                    <input type="text" value="{{ $componente->nombre }}" id="comp_nombre_update" name="comp_nombre_update" class="form-control form-control-sm" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnUpdateComp" class="btn btn-success">{{ __('Actualizar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>