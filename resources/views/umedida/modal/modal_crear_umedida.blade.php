<div class="modal fade" id="modal_crear_medida" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_medidaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_medidaLabel"><strong>{{ __('Agregar Unidad de Medida') }}</strong></h1>
                <button type="button" id="btnCloseAddMedida" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('umedidas') }}" method="POST" class="form-horizontal" id="formulario_crear_medida">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="medida_unidad">{{ __('Unidad') }}: </label>
                                <div class="col-md-10">
                                    <input type="text" id="medida_unidad" name="medida_unidad" class="form-control form-control-sm" autocomplete="off" placeholder="Unidad de medida" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnRegisterMed" class="btn btn-success">{{ __('Registrar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>