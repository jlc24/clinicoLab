<div class="modal fade" id="modal_crear_cultivo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_crear_cultivoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #32C861; color: #fff">
                <h1 class="modal-title fs-5" id="modal_crear_cultivoLabel"><strong>{{ __('Agregar cultivo') }}</strong></h1>
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

                <form action="{{ url('cultivos') }}" method="POST" class="form-horizontal" id="formulario_crear_cultivo">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_clave">{{ __('Clave') }}:</label>
                                <div class="col-md-5" style="display: inline-flex;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" border-radius: 5px 0px 0px 5px; height: 31px;"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input type="text" placeholder="Clave Cultivo" id="cultivo_clave" name="cultivo_clave" class="form-control form-control-sm" autocomplete="off" style="text-transform: uppercase; border-radius: 0px 5px 5px 0px;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check" style="padding-top: 5px; margin-left: 10px;">
                                        <input class="form-check-input" type="checkbox" id="generar_correo_med" name="generar_correo_med" title="Generar Clave"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-sm-12" >
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_nombre">{{ __('Nombre Cultivo') }}: </label>
                                <div class="col-md-8">
                                    <input type="text" id="cultivo_nombre" name="cultivo_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre cultivoudio" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_descripcion">{{ __('Descripcion') }}:</label>
                                <div class="col-md-8">
                                    <textarea class="form-control form-control-sm" name="cultivo_descripcion" id="cultivo_descripcion" cols="35" rows="2" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_muestra">{{ __('Tipo de Muestra') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="cultivo_muestra" name="cultivo_muestra" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        {{-- @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_indicaciones">{{ __('Indicaciones') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="cultivo_indicaciones" name="cultivo_indicaciones" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        {{-- @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_recipiente">{{ __('Recipiente') }}: </label>
                                <div class="col-md-8">
                                    <select class="custom-select custom-select-sm" id="cultivo_recipiente" name="cultivo_recipiente" required>
                                        <option value="" selected="" disabled>SELECCIONAR...</option>
                                        {{-- @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->nombre }}">{{ $departamento->nombre }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-right" for="cultivo_costo">{{ __('Costo') }}: </label>
                                <div class="col-md-5">
                                    <input type="number" min="0" id="cultivo_costo" name="cultivo_costo" class="form-control form-control-sm" autocomplete="off" placeholder="Costo Cultivo" required>
                                </div>
                                <div class="col-md-3">
                                    <select class="custom-select custom-select-sm" id="cultivo_recipiente" name="cultivo_recipiente" required>
                                        <option value="boliviano" selected="">Bs</option>
                                        <option value="dolar">$</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnRegisterMed" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>