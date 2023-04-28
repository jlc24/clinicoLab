<div class="modal fade" id="modal_actualizar_medida_{{ $medida->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_medida_{{ $medida->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_medida_{{ $medida->id }}Label"><strong>{{ __('Modificar Unidad de Medida') }}</strong></h1>
                <button type="button" id="btnCloseUpMed" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('umedidas/'.$medida->id) }}" method="POST" class="form-horizontal" id="formulario_actualizar_medida">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="medida_unidad_update">{{ __('Unidad') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $medida->unidad }}" id="medida_unidad_update" name="medida_unidad_update" class="form-control form-control-sm" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnRegisterMed" class="btn btn-success">{{ __('Actualizar') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>