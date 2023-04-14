<div class="modal fade" id="modal_crear_caja" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_cajaLabel" aria-hidden="true">
    <div class="modal-dialog mdoal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_cajaLabel"><strong>{{ __('Apertura inicial de Caja') }}</strong></h1>
                <button type="button" id="btnCloseAddcaja" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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

                <form action="{{ url('cajas') }}" method="POST" class="form-horizontal" id="formulario_crear_caja">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="caja_administrador">{{ __('Administrador') }}:</label>
                                <div class="col-md-8" style="display: inline-flex">
                                    <input type="text" value="{{ Auth::user()->user }}" id="caja_administrador" name="caja_administrador" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                    <div class="input-group-prepend" >
                                        <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px;"><i class="fas fa-user"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="caja_fecha_apertura">{{ __('Fecha Apertura') }}:</label>
                                <div class="col-md-8" style="display: inline-flex">
                                    <input type="datetime" value="{{ now()->timezone('-4') }}" id="caja_fecha_apertura" name="caja_fecha_apertura" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px;" onkeyup="javascript:this.value=this.value.toUpperCase();" readonly>
                                    <div class="input-group-prepend" >
                                        <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px;"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label" for="caja_monto_apertura">{{ __('Monto Apertura') }}:</label>
                                <div class="col-md-8" style="display: inline-flex">
                                    <input type="hidden" value="1" name="caja_estado" id="caja_estado">
                                    <input type="number" step="0.01" value="0.00" id="caja_monto_apertura" name="caja_monto_apertura" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 5px 0px 0px 5px;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                    <div class="input-group-prepend" >
                                        <div class="input-group-text" style=" border-radius: 0px 5px 5px 0px; height: 31px;"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" id="btnCloseAddClient" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button id="btnRegisterCaja" class="btn btn-success" data-dismiss="modal">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
