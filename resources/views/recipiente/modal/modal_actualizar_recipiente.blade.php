<div class="modal fade" id="modal_actualizar_recipiente_{{ $recipiente->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_actualizar_recipiente_{{ $recipiente->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_actualizar_recipiente_{{ $recipiente->id }}Label"><strong>{{ __('Modificar Recipiente') }}</strong></h1>
                <button type="button" id="btnCloseAddMedic" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('recipientes/'.$recipiente->id) }}" method="POST" class="form-horizontal" id="formulario_modificar_recipiente">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="reci_nombre">{{ __('Nombre Recipiente') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" value="{{ $recipiente->nombre }}" id="reci_nombre" name="reci_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Recipiente" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="reci_descripcion">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="reci_descripcion" id="reci_descripcion" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); ">{{ $recipiente->descripcion }}</textarea>
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