<div id="modal_crear_subgrupo" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_crear_subgrupo-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header" style="background-color: #69A5FD; color: #fff">
                <h5 class="modal-title" id="modal_crear_subgrupo-title">{{ __('Nuevo SubGrupo') }}</h5>
                <button class="close" id="btnCloseAddSubGrupo" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <div class="row">
                    <div class="col-xl-12 col-sm-12" >
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="subgrupos_nombre">{{ __('Nombre') }}: </label>
                            <div class="col-md-8">
                                <input type="text" id="subgrupos_nombre" name="subgrupos_nombre" class="form-control form-control-sm" autocomplete="off" placeholder="Nombre Subgrupo" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnRegisterSubGrupo" class="btn btn-success" data-dismiss="modal">{{ __('Registrar') }}</button>
            </div>
        </div>
    </div>
</div>